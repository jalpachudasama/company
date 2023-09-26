<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;

class UserService
{
    public $url1 = 'https://randomuser.me/api/';
    public $url2 = 'https://www.boredapi.com/api/activity';

    public function getUserDetails($limit)
    {
        try {
            $details = [];
            if($this->getApiResponseByUrl($this->url1)) {
                for ($i = 1; $i <= $limit; $i++) {
                    $details[] = $this->getDetails();
                }
            } else if($this->getApiResponseByUrl($this->url2)) {
                for ($i = 1; $i <= $limit; $i++) {
                    $details[] = $this->getDetails();
                }
            }

            if(!empty($details)) {
                $details = $this->sortByColumnName($details);
            }

            return $details;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getDetails() {
        try {
            if($data = $this->getApiResponseByUrl($this->url1)) {
               $user = $data['results'][0];
               $fullName = $user['name']['first'].' '.$user['name']['last'];
               $result = [
                  'full_name' => $fullName,
                  'phone' =>  $user['phone'],
                  'email' => $user['email'],
                  'country' => $user['location']['country']
               ];
            } else if($data = $this->getApiResponseByUrl($this->url2)) {
                $result = $data;
            } else {
                $result = [];
            }
            return $result;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function sortByColumnName($details) {
        if($details[0] && !empty($details[0]['type'])) {
            $filed = 'type';
        } else if($details[0] && !empty($details[0]['full_name'])) {
           $filed = 'full_name';
        } else {
            $filed = '';
        }

        if(!empty($filed)) {
            $columns = array_column($details, $filed);
            array_multisort($columns, SORT_DESC, $details);
        }

        return $details;
    }

    public function getApiResponseByUrl($url) {
        $response = Http::get($url);
        return $response->json();
    }
}
