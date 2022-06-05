<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;
use App\Models\City;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        function canada_states(){
            $canada_states = array(
                array('code' => "AB",'name' => 'Alberta'),
                array('code' => "BC",'name' => 'British Columbia'),
                array('code' => "MB",'name' => 'Manitoba'),
                array('code' => "NB",'name' => 'New Brunswick'),
                array('code' => "NL",'name' => 'Newfoundland and Labrador'),
                array('code' => "NT",'name' => 'Northwest Territories'),
                array('code' => "NS",'name' => 'Nova Scotia'),
                array('code' => "NU",'name' => 'Nunavut'),
                array('code' => "ON",'name' => 'Ontario'),
                array('code' => "PE",'name' => 'Prince Edward Island'),
                array('code' => "QC",'name' => 'Quebec'),
                array('code' => "SK",'name' => 'Saskatchewan'),
                array('code' => "YT",'name' => 'Yukon'),
            );
            return $canada_states;
        }

        function canada_cities(){
            $canada_cities = array(
                array("stateId" => 1, "name" => "Airdrie"),
                array("stateId" => 1, "name" => "Grande Prairie"),
                array("stateId" => 1, "name" => "Beaumont"),
                array("stateId" => 1, "name" => "St. Albert"),
                array("stateId" => 1, "name" => "Bonnyville"),
                array("stateId" => 1, "name" => "Hinton"),
                array("stateId" => 1, "name" => "Spruce Grove"),
                array("stateId" => 1, "name" => "Brazeau"),
                array("stateId" => 1, "name" => "Irricana"),
                array("stateId" => 1, "name" => "Strathcona County"),
                array("stateId" => 1, "name" => "Breton"),
                array("stateId" => 1, "name" => "Lacombe"),
                array("stateId" => 1, "name" => "Strathmore"),
                array("stateId" => 1, "name" => "Calgary"),
                array("stateId" => 1, "name" => "Leduc"),
                array("stateId" => 1, "name" => "Sylvan Lake"),
                array("stateId" => 1, "name" => "Camrose"),
                array("stateId" => 1, "name" => "Lethbridge"),
                array("stateId" => 1, "name" => "LSwan Hills"),
                array("stateId" => 1, "name" => "Canmore"),
                array("stateId" => 1, "name" => "McLennan"),
                array("stateId" => 1, "name" => "Taber"),
                array("stateId" => 1, "name" => "Didzbury"),
                array("stateId" => 1, "name" => "Medicine Hat"),
                array("stateId" => 1, "name" => "Turner Valley"),
                array("stateId" => 1, "name" => "Drayton Valley"),
                array("stateId" => 1, "name" => "Olds"),
                array("stateId" => 1, "name" => "Vermillion"),
                array("stateId" => 1, "name" => "Edmonton"),
                array("stateId" => 1, "name" => "Onoway"),
                array("stateId" => 1, "name" => "Ft. Saskatchewan"),
                array("stateId" => 1, "name" => "Provost"),
            );
            /*$canada_cities = array(
                "British Columbia" => array(
                ,"Burnaby"
                ,"Lumby"
                ,"City of Port Moody"
                ,"Cache Creek"
                ,"Maple Ridge"
                ,"Prince George"
                ,"Castlegar"
                ,"Merritt"
                ,"Prince Rupert"
                ,"Chemainus"
                ,"Mission"
                ,"Richmond"
                ,"Chilliwack"
                ,"Nanaimo"
                ,"Saanich"
                ,"Clearwater"
                ,"Nelson"
                ,"Sooke"
                ,"Colwood"
                ,"New Westminster"
                ,"Sparwood"
                ,"Coquitlam"
                ,"North Cowichan"
                ,"Surrey"
                ,"Cranbrook"
                ,"North Vancouver"
                ,"Terrace"
                ,"Dawson Creek"
                ,"North Vancouver"
                ,"Tumbler"
                ,"Delta"
                ,"Osoyoos"
                ,"Vancouver"
                ,"Fernie"
                ,"Parksville"
                ,"Vancouver"
                ,"Invermere"
                ,"Peace River"
                ,"Vernon"
                ,"Kamloops"
                ,"Penticton"
                ,"Victoria"
                ,"Kaslo"
                ,"Port Alberni"
                ,"Whistler"
                ,"Langley"
                ,"Port Hardy"
                ),
                "Manitoba" => array(
                "Birtle"
                ,"Flin Flon"
                ,"Swan River"
                ,"Brandon"
                ,"Snow Lake"
                ,"The Pas"
                ,"Cranberry Portage"
                ,"Steinbach"
                ,"Thompson"
                ,"Dauphin"
                ,"Stonewall"
                ,"Winnipeg"
                ), 
                "New Brunswick" => array(
                ,"Cap-Pele"
                ,"Miramichi"
                ,"Saint John"
                ,"Fredericton"
                ,"Moncton"
                ,"Saint Stephen"
                ,"Grand Bay-Westfield"
                ,"Oromocto"
                ,"Shippagan"
                ,"Grand Falls"
                ,"Port Elgin"
                ,"Sussex"
                ,"Memramcook"
                ,"Sackville"
                ,"Tracadie-Sheila"
                ), 
                "Newfoundland And Labrador" => array(
                "Argentia"
                ,"Corner Brook"
                ,"Paradise"
                ,"Bishop's Falls"
                ,"Labrador City"
                ,"Portaux Basques"
                ,"Botwood"
                ,"Mount Pearl"
                ,"St. John's"
                ,"Brigus"
                ),
                "Northwest Territories" => array(
                "Town of Hay River"
                ,"Town of Inuvik"
                ,"Yellowknife"
                ), 
                "Nova Scotia" => array(
                "Amherst"
                ,"Hants County"
                ,"Pictou"
                ,"Annapolis"
                ,"Inverness County"
                ,"Pictou County"
                ,"Argyle"
                ,"Kentville"
                ,"Queens"
                ,"Baddeck"
                ,"County of Kings"
                ,"Richmond"
                ,"Bridgewater"
                ,"Lunenburg"
                ,"Shelburne"
                ,"Cape Breton"
                ,"Lunenburg County"
                ,"Stellarton"
                ,"Chester"
                ,"Mahone Bay"
                ,"Truro"
                ,"Cumberland County"
                ,"New Glasgow"
                ,"Windsor"
                ,"East Hants"
                ,"New Minas"
                ,"Yarmouth"
                ,"Halifax"
                ,"Parrsboro"
                ),
                "Ontario" => array(
                "Ajax"
                ,"Halton"
                ,"Peterborough"
                ,"Atikokan"
                ,"Halton Hills"
                ,"Pickering"
                ,"Barrie"
                ,"Hamilton"
                ,"Port Bruce"
                ,"Belleville"
                ,"Hamilton-Wentworth"
                ,"Port Burwell"
                ,"Blandford-Blenheim"
                ,"Hearst"
                ,"Port Colborne"
                ,"Blind River"
                ,"Huntsville"
                ,"Port Hope"
                ,"Brampton"
                ,"Ingersoll"
                ,"Prince Edward"
                ,"Brant"
                ,"James"
                ,"Quinte West"
                ,"Brantford"
                ,"Kanata"
                ,"Renfrew"
                ,"Brock"
                ,"Kincardine"
                ,"Richmond Hill"
                ,"Brockville"
                ,"King"
                ,"Sarnia"
                ,"Burlington"
                ,"Kingston"
                ,"Sault Ste. Marie"
                ,"Caledon"
                ,"Kirkland Lake"
                ,"Scarborough"
                ,"Cambridge"
                ,"Kitchener"
                ,"Scugog"
                ,"Chatham-Kent"
                ,"Larder Lake"
                ,"Souix Lookout CoC Sioux Lookout"
                ,"Chesterville"
                ,"Leamington"
                ,"Smiths Falls"
                ,"Clarington"
                ,"Lennox-Addington"
                ,"South-West Oxford"
                ,"Cobourg"
                ,"Lincoln"
                ,"St. Catharines"
                ,"Cochrane"
                ,"Lindsay"
                ,"St. Thomas"
                ,"Collingwood"
                ,"London"
                ,"Stoney Creek"
                ,"Cornwall"
                ,"Loyalist Township"
                ,"Stratford"
                ,"Cumberland"
                ,"Markham"
                ,"Sudbury"
                ,"Deep River"
                ,"Metro Toronto"
                ,"Temagami"
                ,"Dundas"
                ,"Merrickville"
                ,"Thorold"
                ,"Durham"
                ,"Milton"
                ,"Thunder Bay"
                ,"Dymond"
                ,"Nepean"
                ,"Tillsonburg"
                ,"Ear Falls"
                ,"Newmarket"
                ,"Timmins"
                ,"East Gwillimbury"
                ,"Niagara"
                ,"Toronto"
                ,"East Zorra-Tavistock"
                ,"Niagara Falls"
                ,"Uxbridge"
                ,"Elgin"
                ,"Niagara-on-the-Lake"
                ,"Vaughan"
                ,"Elliot Lake"
                ,"North Bay"
                ,"Wainfleet"
                ,"Flamborough"
                ,"North Dorchester"
                ,"Wasaga Beach"
                ,"Fort Erie"
                ,"North Dumfries"
                ,"Waterloo"
                ,"Fort Frances"
                ,"North York"
                ,"Waterloo"
                ,"Gananoque"
                ,"Norwich"
                ,"Welland"
                ,"Georgina"
                ,"Oakville"
                ,"Wellesley"
                ,"Glanbrook"
                ,"Orangeville"
                ,"West Carleton"
                ,"Gloucester"
                ,"Orillia"
                ,"West Lincoln"
                ,"Goulbourn"
                ,"Osgoode"
                ,"Whitby"
                ,"Gravenhurst"
                ,"Oshawa"
                ,"Wilmot"
                ,"Grimsby"
                ,"Ottawa"
                ,"Windsor"
                ,"Guelph"
                ,"Ottawa-Carleton"
                ,"Woolwich"
                ,"Haldimand-Norfork"
                ,"Owen Sound"
                ,"York"
                ),
                ",Prince Edward Island" => array(
                "Alberton"
                ,"Montague"
                ,"Stratford"
                ,"Charlottetown"
                ,"Souris"
                ,"Summerside"
                ,"Cornwall"
                ),
                ",Quebec" => array(
                "Alma"
                ,"Fleurimont"
                ,"Longueuil"
                ,"Amos"
                ,"Gaspe"
                ,"Marieville"
                ,"Anjou"
                ,"Gatineau"
                ,"Mount Royal"
                ,"Aylmer"
                ,"Hull"
                ,"Montreal"
                ,"Beauport"
                ,"Joliette"
                ,"Montreal Region"
                ,"Bromptonville"
                ,"Jonquiere"
                ,"Montreal-Est"
                ,"Brosssard"
                ,"Lachine"
                ,"Quebec"
                ,"Chateauguay"
                ,"Lasalle"
                ,"Saint-Leonard"
                ,"Chicoutimi"
                ,"Laurentides"
                ,"Sherbrooke"
                ,"Coaticook"
                ,"LaSalle"
                ,"Sorel"
                ,"Coaticook"
                ,"Laval"
                ,"Thetford Mines"
                ,"Dorval"
                ,"Lennoxville"
                ,"Victoriaville"
                ,"Drummondville"
                ,"Levis"
                ), 
                ",Saskatchewan" => array(
                "Avonlea"
                ,"Melfort"
                ,"Swift Current"
                ,"Colonsay"
                ,"Nipawin"
                ,"Tisdale"
                ,"Craik"
                ,"Prince Albert"
                ,"Unity"
                ,"Creighton"
                ,"Regina"
                ,"Weyburn"
                ,"Eastend"
                ,"Saskatoon"
                ,"Wynyard"
                ,"Esterhazy"
                ,"Shell Lake"
                ,"Yorkton"
                ,"Gravelbourg"
                ),
                "Yukon" => array(
                ,"Carcross"
                ,"Whitehorse"
                ));*/
            return $canada_cities;
        }
                // creating divisions
                foreach(canada_states() as $state) {
                    $stateModel = new State();
                    $stateModel->name = $state['name'];
                    $stateModel->save();
                }
        
        
                // creating districts
                foreach(canada_cities() as $city) {
                    $cityModel = new City();
                    $cityModel->name = $city['name'];
                    $cityModel->stateId = $city['stateId'];
                    $cityModel->save();
                }
    }
}
