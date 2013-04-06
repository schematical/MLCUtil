<?php
/* 
 * 
 */
class MLCGeoCodeRequest{
    const XML = 'xml';
    const KML = 'kml';
    const CSV = 'csv';
    const JSON = 'json';
    //200 	G_GEO_SUCCESS 	No errors occurred; the address was successfully parsed and its geocode was returned.
    const G_GEO_SUCCESS = 200;
    //500 	G_GEO_SERVER_ERROR 	A geocoding or directions request could not be successfully processed, yet the exact reason for the failure is unknown.
    const G_GEO_SERVER_ERROR = 500;
    //601 G_GEO_MISSING_QUERY 	An empty address was specified in the HTTP q parameter.
    const G_GEO_MISSING_QUERY = 601;
    //602 	G_GEO_UNKNOWN_ADDRESS 	No corresponding geographic location could be found for the specified address, possibly because the address is relatively new, or because it may be incorrect.
    const G_GEO_UNKNOWN_ADDRESS = 602;
    //603 	G_GEO_UNAVAILABLE_ADDRESS 	The geocode for the given address or the route for the given directions query cannot be returned due to legal or contractual reasons.
    const G_GEO_UNAVAILABLE_ADDRESS = 603;
    //610 	G_GEO_BAD_KEY 	The given key is either invalid or does not match the domain for which it was given.
    const G_GEO_BAD_KEY = 610;
    //620 	G_GEO_TOO_MANY_QUERIES 	The given key has gone over the requests limit in the 24 hour period or has submitted too many requests in too short a period of time. If you're sending multiple requests in parallel or in a tight loop, use a timer or pause in your code to make sure you don't send the requests too quickly.
    const G_GEO_TOO_MANY_QUERIES = 620;

    
    protected $strAddress1 = null;
    protected $strAddress2 = null;
    protected $strCity = null;
    protected $strState = null;
    protected $strZip = null;
    protected $strLat = null;
    protected $strLong = null;
    protected $intStatusCd = null;


    public function __construct() {
        
    }
    public function Request(){
        //*  q (required) — The address that you want to geocode. Note that this address must be encoded in UTF-8.*
        $strQuery = $this->strAddress1;
        if(!is_null($this->strAddress2)){
            $strQuery .= " " . $this->strAddress2;
        }
        $strQuery .= sprintf(" %s, %s %s", $this->strCity, $this->strState, $this->strZip);
        
        //* key (required) — Your API key.
        $strKey = __GOOGLE_API_KEY__;
        //* sensor (required) — Indicates whether or not the geocoding request comes from a device with a location sensor. This value must be either true or false. (Note that devices with sensors generally perform their own geocoding by definition; therefore, most geocoding requests to the Maps API Geocoding service should set sensor to false.)
        $strSensor = 'false';
        //* output (required) — The format in which the output should be generated. The options are xml, kml, csv, or (default) json. (For more information, see Geocoding Responses below.)
        $strOutput = self::XML;
        //* ll (optional) — The {latitude,longitude} of the viewport center expressed as a comma-separated string (e.g. "ll=40.479581,-117.773438" ). This parameter only has meaning if the spn parameter is also passed to the geocoder. (For more information see Viewport Biasing below.)
        //* spn (optional) — The "span" of the viewport expressed as a comma-separated string of {latitude,longitude} (e.g. "spn=11.1873,22.5" ). This parameter only has meaning if the ll parameter is also passed to the geocoder. (For more information see Viewport Biasing below.)
        //* gl (optional) — The country code, specified as a ccTLD ("top-level domain") two-character value. (For more information see Country Code Biasing below.)


        $strUrl = __GOOGLE_GEOCODE_URL__ ;
        $strUrl .= "q=". $strQuery . "&";
        $strUrl .= "key=" . $strKey . "&";
        $strUrl .= "sensor=" . $strSensor . "&";
        $strUrl .= "output=" . $strOutput . "&";
        $xmlResponse = simplexml_load_file($strUrl);

        if(!isset($xmlResponse) || is_null($xmlResponse)){
            throw new Exception("XML Unavailable");
        }
        $this->intStatusCd = $xmlResponse->Response->Status->code;
        if($this->intStatusCd != self::G_GEO_SUCCESS){
            return false;
        }


    
        $strCoordinates = $xmlResponse->Response->Placemark->Point->coordinates;
        $arrCoordinates = explode(',', $strCoordinates);
        $this->strLat = $arrCoordinates[1];
        $this->strLong = $arrCoordinates[0];

        return true;

    }
    public function __get($strName) {
        switch($strName){
            case('Address1'): return $this->strAddress1;
            case('Address2'): return $this->strAddress2;
            case('City'): return $this->strCity;
            case('State'): return $this->strState;
            case('Zip'): return $this->strZip;
            case('Lat'): return $this->strLat;
            case('Long'): return $this->strLong;
            default:
                break;
        }
    
    }
    public function __set($strName, $mixValue) {
        switch($strName){
            case('Address1'):
                $this->strAddress1 = $mixValue;
                break;
            case('Address2'):
                $this->strAddress2 = $mixValue;
                break;
            case('City'):
                $this->strCity = $mixValue;
                break;
            case('State'):
                $this->strState = $mixValue;
                break;
            case('Zip'):
                $this->strZip = $mixValue;
                break;
            case('Lat'):
                $this->strLat = $mixValue;
                break;
            case('Long'):
                $this->strLong = $mixValue;
                break;
            default:

                break;
            
        }
    }

}
?>
