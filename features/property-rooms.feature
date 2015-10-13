Feature: Property Rooms
  Each property should have rooms associated with it, which have a name, size, and description.
  
  Scenario: Property Rooms
    Given there is a property with a room and agent ref 123456
    When I find a property with agent ref 123456
    Then the room should have a description
    And the room should have a title
    And the room should have measurements