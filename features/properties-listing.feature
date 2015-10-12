Feature: List Properties
  Users should be able to see a list of properties,
  These properties should be split into rentable and purchasable properties.
  
  Scenario: List rental properties
    Given there are 5 rental properties
    And there is 1 sale property
    When I list rental properties
    Then I should only see 5 properties
    And they should all be properties for rent
    
  Scenario: List sale properties
    Given there are 5 sale properties
    When I list sale properties
    Then I should only see 5 properties
    And they should all be properties for sale
    
  Scenario: List rental properties between £500 and £1000
    Given there are 5 rental properties with 1 priced under £1000
    When I list rental properties between £500 and £1000
    Then I should only see properties between £500 and £1000
    And I should see 1 properties
    
  Scenario: List sale properties between £50,000 and £100,000
    Given there are 5 sale properties with 1 priced under £100,000
    When I list sale properties between £50,000 and £100,000
    Then I should only see properties between £50,000 and £100,000
    And I should see 1 properties
  
  Scenario: Find a property by it's agent ref
    Given there is a property with agent ref 123456
    When I find a property with agent ref 123456
    Then I should see a property with agent ref 123456
  