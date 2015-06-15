<?php


class SeoLinks {

    /**
     * @param $input The link to be changed.
     * @param string $replace use letter for replacemnt.
     * @param bool $remove_words
     *
     * @return mixed SEO Friendly link
     */
    public static function generate_seo_link($input, $replace = '-', $remove_words = true) {


        //make it lowercase, remove punctuation, remove multiple/leading/ending spaces
        $return = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $input);
        $return =  trim($return, '-');
        $return = strtolower($return);
        $return = preg_replace("/[\/_|+ -]+/", '-', $return);
      //  $return = trim(preg_replace(' +', ' ', preg_replace('/[^a-zA-Z0-9\s]/', '', strtolower($input))));

        //remove words, if not helpful to seo
        //i like my defaults list in remove_words(), so I wont pass that array
        if($remove_words) {
            $words_array = ['a','and','the','an','it','is','with','can','of','why','my'];
            $unique_words = true;

            //separate all words based on spaces
            $input_array = explode(' ',$input);

            //create the return array
            $return = array();

            //loops through words, remove bad words, keep good ones
            foreach($input_array as $word)
            {
                //if it's a word we should add...
                if(!in_array($word,$words_array) && ($unique_words ? !in_array($word,$return) : true))
                {
                    $return[] = strtolower($word);
                }
            }

            $return = implode($replace,$return);


         }

        //convert the spaces to whatever the user wants
        //usually a dash or underscore..
        //...then return the value.
        return str_replace(' ', $replace, $return);
    }

}