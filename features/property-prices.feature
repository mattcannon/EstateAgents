Feature: Property Prices
  Properties should have pricing information.
  They should have a default price of 0.
  For rental properties, they should have payment frequencies.
  
  Scenario: New Property should have a price of £0
    Given there is a new property
    Then it's price should be equal to £0.00
    
  Scenario: New property with price set
    Given there is a new property
    And it has a price of £100,000
    Then it's price should be equal to £100000
    
  Scenario: New sales property
    Given there is a new sales property
    Then it's payment frequency should be empty

  Scenario: New rental property
    Given there is a new rental property
    And it's payment frequency is set to weekly
    Then it's payment frequency should be equal to "pw"
  
  Scenario: New rental property
    Given there is a new rental property
    And it's payment frequency is set to monthly
    Then it's payment frequency should be equal to "pcm"