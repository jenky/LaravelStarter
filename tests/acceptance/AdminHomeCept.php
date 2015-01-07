<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('open index page of site');
$I->amOnPage('/admin');
$I->see('Login');