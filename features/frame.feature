Feature: Manage Frame
  In order to manage a frame
  As a user
  I need to be able to manage it with cli

  Scenario: Start a new frame
    Given I have no frame already registered
    When I start a new frame
    Then I should have 1 frame registered