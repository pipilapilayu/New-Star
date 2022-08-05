<div class="spy-report">
	<div class="spy-report-header">
		<a href="game.php?page=galaxy&amp;galaxy={$targetPlanet.galaxy}&amp;system={$targetPlanet.system}">{$title}</a>
	</div>
	{foreach $spyData as $Class => $elementIDs}
	<div class="spy-report-class spy-report-class-{$Class}">
	<div class="spy-report-class-header">{$LNG.tech.$Class}</div>
	{foreach $elementIDs as $elementID => $amount}
	{if $amount > 0}
	<div class="spy-report-row clearfix">
		<div class="spy-report-element-name">{$LNG.tech.$elementID}</div>
		<div class="spy-report-element-amount">{$amount|number}</div>
	</div>
	{/if}
	{/foreach}
	</div>
	{/foreach}
	<div class="spy-report-footer">
		<a href="game.php?page=fleetTable&amp;galaxy={$targetPlanet.galaxy}&amp;system={$targetPlanet.system}&amp;planet={$targetPlanet.planet}&amp;planettype={$targetPlanet.planet_type}&amp;target_mission=1">{$LNG.type_mission_1}</a>
		<br>{if $targetChance >= $spyChance}{$LNG.sys_mess_spy_destroyed}{else}{strtr($LNG.sys_mess_spy_lost_chance, ['{value}' => $targetChance])}{/if}
		{if $isBattleSim}<br><a href="game.php?page=battleSimulator{foreach $spyData as $Class => $elementIDs}{foreach $elementIDs as $elementID => $amount}&amp;im[{$elementID}]={$amount}{/foreach}{/foreach}">{$LNG.fl_simulate}</a>{/if}
	</div>
</div>