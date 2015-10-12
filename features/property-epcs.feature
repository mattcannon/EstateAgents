Feature: Property epcs
  A property should be able to return a collection of epc objects, which have a url, and a caption.

  Scenario: Property epc URL and Caption
    Given there is a property with a epc located at "http://imageurl.com/image.jpg" with a caption of "test caption"
    Then it should return an array with 1 epc
    And its first epc should have a url of "http://imageurl.com/image.jpg" with a caption of "test caption"

  Scenario: Multiple Property epcs
    Given there is a property with 3 epcs
    Then it should return an array with 3 epcs
    
    