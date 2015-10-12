Feature: Property Images
  A property should be able to return a collection of image objects, which have a url, and a caption.
  It should also be able to return a main image.

  Scenario: Main Property Image
    Given there is a property with an image located at "http://imageurl.com/image.jpg" with a caption of "test caption"
    Then it should return an array with 1 image
    And its first image should have a url of "http://imageurl.com/image.jpg" with a caption of "test caption"

  Scenario: Multiple Property Images
    Given there is a property with 3 images
    Then it should return an array with 3 images
    
    