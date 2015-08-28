Feature: Testing behat integration
  In order to build test suite
  I have to configure behat environment

  Scenario: testing behat with mink and kernel driver can open application url correctly
    Given I am a guest user
    When I am on "/app_test.php"
    Then I should see "memy.tk"
    And I should see "twój osobisty folder z obrazkami reakcyjnymi"
