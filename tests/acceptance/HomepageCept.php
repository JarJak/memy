<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('see homepage');
$I->amOnPage('/');
$I->see("memy.tk");
$I->see("twój osobisty folder z obrazkami reakcyjnymi");