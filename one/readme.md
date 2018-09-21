Kata One — PHP: XML
--------------------

## Story
### Extract wikipedia "Picture of the day" for a month in a CSV file
* Load the HTML in a DOMDocument object
* Filter this document with a DOMXpath
* Use a XSLTProcessor to transform the input to a csv file

## Steps
1. Turn off potential warnings because of incorrect XML.
2. Create a DOMDocument and load the HTML with the loadHTML method.
3. Create a DOMXPath, and perform a query to select only the table containing all images.
4. Create a new DOMDocument and import the selected nodes in it
    1. Ordered lists can also be nested
5. Create a XSL stylesheet to create a CSV file with format:
    1. "day (h2)":"description (img alt)";"url (img src)"
6. Restore previous warning mode.

