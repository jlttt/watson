Feature: Manage Project
  In order to manage a project
  As a user
  I need to be able to manage it

  Scenario: Find a project
    Given I have a project "first"
    And I have a project "second"
    When I search the project by name "second"
    Then I should obtain a project named "second"
  
  Scenario: Find no project
    Given I have a project "first"
    And I have a project "second"
    When I search the project by name "third"
    Then I should obtain no project