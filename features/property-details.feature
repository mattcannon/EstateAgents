Feature: Property details
  
  Scenario: Property Display Address
    Given there is a detailed property with agent ref 123456
    When I find a detailed property with agent ref 123456
    Then it should have a display address

  Scenario: Property Features
    Given there is a detailed property with agent ref 123456
    When I find a detailed property with agent ref 123456
    Then it should have an array of features

  Scenario: Property Description
    Given there is a detailed property with agent ref 123456
    When I find a detailed property with agent ref 123456
    Then it should have a description

  Scenario: Property Rooms
    Given there is a detailed property with agent ref 123456
    When I find a detailed property with agent ref 123456
    Then it should return the number of bedrooms

  Scenario: Property Type
    Given there is a detailed property with agent ref 123456
    When I find a detailed property with agent ref 123456
    Then it should return the property type
  
  Scenario: Property Location
    Given there is a property with agent ref 123456 which has a latitude of "52.8" and a longitude of "-0.8"
    Then it should have a location property
