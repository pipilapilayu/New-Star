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

$planetData	= array(
	1 => array(
        'temp' => mt_rand(200, 400),	
        'fields' => mt_rand(10, 150),
        'color' => '#FF0000',      
        'image' => array(
            'trocken' => mt_rand(1, 10), 
            'wuesten' => mt_rand(1, 4))),
            
	2 => array(
        'temp' => mt_rand(170, 200),	
        'fields' => mt_rand(40, 160),
        'color' => '#FF1010',
        'image' => array(
            'trocken' => mt_rand(1, 10), 
            'wuesten' => mt_rand(1, 4))),
            
	3 => array(
        'temp' => mt_rand(120, 160),	
        'fields' => mt_rand(50, 200),
        'color' => '#FF2222',
        'image' => array(
            'trocken' => mt_rand(1, 10), 
            'wuesten' => mt_rand(1, 4))),
            
	4 => array(
        'temp' => mt_rand(70, 110),	
        'fields' => mt_rand(100, 250),	
        'color' => '#FE3333',
        'image' => array(
            'dschjungel' => mt_rand(1, 10))),
            
	5 => array(
        'temp' => mt_rand(60, 100),	
        'fields' => mt_rand(100, 280),	
        'color' => '#FC4242',
        'image' => array(
            'dschjungel' => mt_rand(1, 10))),
            
	6 => array(
        'temp' => mt_rand(50, 90),		
        'fields' => mt_rand(100, 306),	
        'color' => '#FC5353',
        'image' => array(
            'dschjungel' => mt_rand(1, 10))),
            
	7 => array(
        'temp' => mt_rand(40, 80),		
        'fields' => mt_rand(100, 320),	
        'color' => '#FF6B6B',
        'image' => array(
            'normaltemp' => mt_rand(1, 7))),
            
	8 => array(
        'temp' => mt_rand(30, 70),		
        'fields' => mt_rand(100, 350),	
        'color' => '#FF8383',
        'image' => array(
            'normaltemp' => mt_rand(1, 7))),
            
	9 => array(
        'temp' => mt_rand(20, 60),		
        'fields' => mt_rand(100, 360),	
        'color' => '#FD9898',
        'image' => array(
            'normaltemp' => mt_rand(1, 7), 
            'wasser' => mt_rand(1, 9))),
            
	10 => array(
        'temp' => mt_rand(10, 50),		
        'fields' => mt_rand(120, 280),	
        'color' => '#D0E5FF',
        'image' => array(
            'normaltemp' => mt_rand(1, 7), 
            'wasser' => mt_rand(1, 9))),
            
	11 => array(
        'temp' => mt_rand(0, 40),		
        'fields' => mt_rand(110, 270),	
        'color' => '#B0D2FC',
        'image' => array(
            'normaltemp' => mt_rand(1, 7), 
            'wasser' => mt_rand(1, 9))),
            
	12 => array(
        'temp' => mt_rand(-10, 30),	
        'fields' => mt_rand(50, 250),	
        'color' => '#98C6FE',
        'image' => array(
            'normaltemp' => mt_rand(1, 7), 
            'wasser' => mt_rand(1, 9))),
            
	13 => array(
        'temp' => mt_rand(-50, -10),	
        'fields' => mt_rand(30, 200),
        'color' => '#88BDFF',        
        'image' => array(
            'eis' => mt_rand(1, 10))),
            
	14 => array(
        'temp' => mt_rand(-90, -50),	
        'fields' => mt_rand(10, 150),
        'color' => '#6DAEFE',
        'image' => array(
            'eis' => mt_rand(1, 10))),
            
	15 => array(
        'temp' => mt_rand(-130, -90),	
        'fields' => mt_rand(1, 150),	
        'color' => '#57A3FF',
        'image' => array(
            'eis' => mt_rand(1, 10)))
);