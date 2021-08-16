<?php
require_once 'includes/api_config.php';

/** Class to retrieve and process Holidays data */
class Holidays
{
    public function __construct()
    {
        
    }

    /**
     * Method to call API and fetch results
     *
     * @param int $year
     * @return string
     */
    function callApi($year)
    {
        /** Initialise cURL */
        $ch = curl_init();

        /** Build url */
        $day = 20;
        $url = API_ENDPOINT . '?api_key=' . API_KEY . '&country=' . API_COUNTRY . '&year=' . $year . '&month=03&day=' . $day;

        curl_setopt($ch, CURLOPT_URL, $url);

        /** Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable. */ 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        /** Set CURLOPT_FOLLOWLOCATION to true to follow redirects */ 
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        /** Execute the request. */ 
        $data = curl_exec($ch);

        /** Close cURL handle */ 
        curl_close($ch);

        return $data;
    }

    /**
     * Method to process API data retrieved
     *
     * @param array $years
     * @return array
     */
    function getApiData($years)
    {
        $equinoxDates= [];
        
        foreach ($years as $year) {
            sleep(1);

            $rawData = $this->callApi($year);
            $data = json_decode($rawData);

            /** Build array of dates retrieved */
            foreach ($data as $key => $value) {
                $equinoxDates[$year] = [
                    'date' => $value->date,
                    'title' => $value->name
                ];
            }           
        }
        
        return $equinoxDates;
    }
}