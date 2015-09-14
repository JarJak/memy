<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('add a meme');
$I->amOnPage('/');
$I->click('Dodaj');
$I->canSeeInCurrentUrl('/dodaj');
$I->see('Dodaj mem', 'h1');
//$I->attachFile('#memy_memebundle_meme_filename', 'testmeme.jpg');
$I->click('[type=submit]');
$I->dontSee('Mem został dodany', 'h1');
//to be continued