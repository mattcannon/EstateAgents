Feature: Property floorplans
  A property should be able to return a collection of floorplan objects, which have a url, and a caption.

  Scenario: Property floorplan URL and Caption
    Given there is a property with a floorplan located at "http://imageurl.com/image.jpg" with a caption of "test caption"
    Then it should return an array with 1 floorplan
    And its first floorplan should have a url of "http://imageurl.com/image.jpg" with a caption of "test caption"

  Scenario: Multiple Property floorplans
    Given there is a property with 3 floorplans
    Then it should return an array with 3 floorplans
    
    