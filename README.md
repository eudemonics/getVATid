*PHP SCRIPT: getVATid v1.0*

*AUTHOR: vvn [vvn @ notworth.it]*

*INITIAL RELEASE DATE: January 22, 2014*

*DESCRIPTION: Finds and generates a list of valid VAT ID's for the country of your choice using brute-force auto-incrementing queries against the exposed public web services WSDL.*

*USER LICENSE AGREEMENT & DISCLAIMER*

copyright, copyleft (C) 2014  vvn [vvn @ notworth.it]

This program is FREE software: you can use it, redistribute it and/or modify it as you wish. Copying and distribution of this file, with or without modification, are permitted in any medium without royalty provided the copyright notice and this notice are preserved. This program is offered AS-IS, WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

For more information, please refer to the "LICENSE AND NOTICE" file that should
accompany all official download releases of this program.

VAT number formats for each specific EU country can be found below.

SOURCE:
>>>http://www.pixelgenius.com/vat-id.html

Just change countryCode value to the country of your choice, and modify the for loop to match that country's algorithm.

you can set the initial string to start the loop at by assigning it to `'$vatIdinit'`

*assign initial string value for variable $vatIdinit to start the query loop (optional), or the script will start from the very beginning (may take longer). make sure the format of the string adheres to target country's VAT ID format.*

you can also set the $count and $match variables with the amount of queries executed against the API ($count) and the number of matches in response ($match) so that the results file remains consistent.

>>$vatIdinit = '012345678';
>>
>>$count = 0;
>>
>>$match = 0;


*TABLE OF EUROPEAN VAT ID FORMATS BY COUNTRY*

EU COUNTRY (CODE)         FORMAT TO USE 	                        EXAMPLE


AUSTRIA (AT)              9 characters, first always a U         	U12345678

BELGIUM (BE)              9 characters 	                          123456789

DENMARK (DK)              8 characters 	                          12345678

FINLAND (FI)              8 characters 	                          123456788

FRANCE (FR)               4 formats, all 11 characters
                          • All digits                            12345678901
                          • First character is alpha              X1123456789
                          • Second character is alpha             1X123456789
                          • 1st & 2nd characters alpha            XX123456789
                          
GERMANY (DE)            	9 characters 	                          123456789

GREECE (EL)    	          9 characters                     	      123456789

IRELAND (IE)            	2 formats, both 8 characters:
                          • Last character is alpha               1234567X
                          • 2nd & last characters alpha 	        1X34567X
                          
ITALY (IT) 	              11 characters 	                        12345678901

LUXEMBOURG (LU)         	8 characters 	                          12345678
                	        12 characters, the 3-digit suffix
                	
NETHERLANDS (NL)          always be in the format B01             123456789B01

PORTUGAL (PT) 	          9 characters 	                          123456789

SPAIN (ES)        	      3 formats, all 9 characters:
                          • 1st character is alpha                X12345678
                          • Last character is alpha               12345678X
                          • 1st & last characters alpha 	        X1234567X
                          
SWEDEN (SE)               10 characters                           1234567890

UNITED KINGDOM (GB)       9 characters                          	123456789


FIND UK COMPANY NUMBER HERE:

>>http://wck2.companieshouse.gov.uk/wcframe?name=accessCompanyInfo

**SEE COMMENTS IN PHP SCRIPT FILE FOR MORE INFORMATION**

========
getVATid
========

initial commit
>>>>>>> 6bdcf02171c73d040ffa56c2f044565127b66c3>>4
