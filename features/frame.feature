Feature: Manage Frame
  In order to manage a frame
  As a user
  I need to be able to manage it with cli

  Scenario: Start a new frame
    Given I have no frame already registered
    When I start a new frame for project "First Project"
    Then I should have 1 frame registered
    And The running frame should be for project "First Project"

  Scenario: Try to start a new frame when one is already in progress
    Given I have a frame in progress for project "First Project"
    When I start a new frame for project "Second Project"
    Then The running frame should be for project "First Project"

  Scenario: Stop a frame in progress
    Given I have a frame in progress for project "First Project"
    When I stop the frame in progress
    Then I should have no more running frame
    And I should have 1 frame registered