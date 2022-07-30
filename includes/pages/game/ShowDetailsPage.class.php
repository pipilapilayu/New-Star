<?php

/*
 * ╔══╗╔══╗╔╗──╔╗╔═══╗╔══╗╔╗─╔╗╔╗╔╗──╔╗╔══╗╔══╗╔══╗
 * ║╔═╝║╔╗║║║──║║║╔═╗║║╔╗║║╚═╝║║║║║─╔╝║╚═╗║║╔═╝╚═╗║
 * ║║──║║║║║╚╗╔╝║║╚═╝║║╚╝║║╔╗─║║╚╝║─╚╗║╔═╝║║╚═╗──║║
 * ║║──║║║║║╔╗╔╗║║╔══╝║╔╗║║║╚╗║╚═╗║──║║╚═╗║║╔╗║──║║
 * ║╚═╗║╚╝║║║╚╝║║║║───║║║║║║─║║─╔╝║──║║╔═╝║║╚╝║──║║
 * ╚══╝╚══╝╚╝──╚╝╚╝───╚╝╚╝╚╝─╚╝─╚═╝──╚╝╚══╝╚══╝──╚╝
 *
 * @author Tsvira Yaroslav <https://github.com/Yaro2709>
 * @info ***
 * @link https://github.com/Yaro2709/New-Star
 * @Basis 2Moons: XG-Project v2.8.0
 * @Basis New-Star: 2Moons v1.8.0
 */

class ShowDetailsPage extends AbstractGamePage
{
	public static $requireModule = MODULE_DETAILS;

	function __construct() 
	{
		parent::__construct();
	}

	public function UpdateDetails($Element)
	{
		global $PLANET, $USER, $reslist, $resource, $pricelist, $LNG, $BonusElement;
		
        $costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $Element);
			
		if ( !BuildFunctions::isElementBuyable($USER, $PLANET, $Element, $costResources)) {
			return;
		}

        	$amount = HTTP::_GP('amount', 0);
        	$href = 'game.php?page=details';         	
		$bonus = 1;

// check before doing actual change
// TODO these codes are copied from UpdateMaxAmount, UpdateResAmount and UpdateSqlBonusElementNole,
// it is architecture level error to mix checks and actual changes to global state and database
if($amount > $pricelist[$Element]['max']){
    $this->printMessage(''.$LNG['bd_limit'].'',true, array($href, 2));	
}
foreach($reslist['resstype'][1] as $resPM)
{
    if(isset($costResources[$resPM])) {
        if($PLANET[$resource[$resPM]] < $costResources[$resPM]* $amount){
            $this->printMessage("".$LNG['bd_notres']."", true, array($href, 2));
        }
    }
}
        
foreach($reslist['resstype'][3] as $resUM)
{
    if(isset($costResources[$resUM])) {
        if($USER[$resource[$resUM]] < $costResources[$resUM]* $amount){
            $this->printMessage("".$LNG['bd_notres']."", true, array($href, 2));
        }
    }
}
if(isset($BonusElement[$Element]))
{
    foreach($BonusElement[$Element] as $ID => $Count)
    {
        if(isset($PLANET[$resource[$ID]])){
            if($PLANET[$resource[$ID]] + $Count * $amount * $bonus < 0){
                $this->printMessage(''.$LNG['bd_notres'].'', true, array('game.php?page=details', 2));
            }        }else{
            if($USER[$resource[$ID]] + $Count * $amount * $bonus < 0){
                $this->printMessage(''.$LNG['bd_notres'].'', true, array('game.php?page=details', 2));
            }
        }
    }
}

		$USER[$resource[$Element]]	+= $amount;

        	require_once('includes/subclasses/subclass.UpdateMaxAmount.php');
       		require_once('includes/subclasses/subclass.UpdateResAmount.php');

        	require_once('includes/subclasses/subclass.UpdateSqlBonusElementNole.php');
		require_once('includes/subclasses/subclass.UpdateSqlGeneral.php');
	}
	
	public function show()
	{
		global $USER, $PLANET, $resource, $reslist, $LNG, $pricelist, $requeriments;
		
		$updateID	  = HTTP::_GP('id', 0);
        $listDetails  = explode(',', Config::get()->details_cron);
		
		if (!empty($updateID) && $_SERVER['REQUEST_METHOD'] === 'POST' && $USER['urlaubs_modus'] == 0)
		{
			if(in_array($updateID, $listDetails)) {
				$this->UpdateDetails($updateID);
			}
		}
		
		$this->tplObj->loadscript('officier.js');	
        
		
		$detailsList	= array();
		
		if(isModuleAvailable(MODULE_DETAILS)) 
		{
			foreach($listDetails as $Element)
			{
                $bonusElementList   = BuildFunctions::bonusElementList($Element);
				$costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $Element);
				$buyable			= BuildFunctions::isElementBuyable($USER, $PLANET, $Element, $costResources);
				$costOverflow		= BuildFunctions::getRestPrice($USER, $PLANET, $Element, $costResources);
				
				$detailsList[$Element]	= array(
                    'level'				=> $USER[$resource[$Element]],
                    'maxLevel'			=> $pricelist[$Element]['max'],
                    'factor'		    => $pricelist[$Element]['factor'],
					'costResources'	    => $costResources,
					'buyable'			=> $buyable,
					'costOverflow'		=> $costOverflow,
					'AllTech'			=> $bonusElementList,
				);
			}
		}
        
        $detailsOverview	= array();
		
		if(isModuleAvailable(MODULE_DETAILS))
		{
			foreach($reslist['details'] as $Element)
			{
				$elementBonus		= BuildFunctions::getAvalibleBonus($Element);
				
				$detailsOverview[$Element]	= array(
					'level'				=> $USER[$resource[$Element]],
                    'factor'		    => $pricelist[$Element]['factor'],
					'elementBonus'		=> $elementBonus,
				);
			}
		}
        
        $sql =  "SELECT nextTime FROM %%CRONJOBS%% WHERE cronjobID = :cronId;";
		$nextTime = Database::get()->selectSingle($sql, array(
			':cronId'			=> 9
		), 'nextTime');
        
        require_once 'includes/classes/Cronjob.class.php';
		
		$this->assign(array(	
			'detailsList'	    => $detailsList,
            'detailsOverview'	=> $detailsOverview,
            'nextStatUpdate' 	=> abs(TIMESTAMP - $nextTime),
            'stat_date'			=> _date($LNG['php_tdformat'], Cronjob::getLastExecutionTime('details'), $USER['timezone']),
		));
		
		$this->display('page.details.default.tpl');
	}
}
