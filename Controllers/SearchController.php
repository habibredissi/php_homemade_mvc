<?php

class Search extends Controller
{
    public function index()
    {
        $searchCat = $this->loadModel('MCategories');
        $searchUser = $this->loadModel('MUsers');
        $searchPost = $this->loadModel('MPosts');
        $htmlSearch = '';
        
        if(isset($_POST['search']))
        {
            if($_POST['options'] == 0)
            {
                $dataSearchCat = $searchCat->search($_POST['search']);
                $dataSearchUser = $searchUser->search($_POST['search']);
                $dataSearchPost = $searchPost->search($_POST['search']);

                foreach ($dataSearchCat as $key => $value) {
                    $htmlSearch .= '<tr>
                    <th scope="row">'.$value->id.'</th>
                    <td>'.$value->title.'</td>
                    <td><a href="http://localhost/PHP_Rush_MVC/Webroot/posts/read/'.$value->id.'">[View]</a></td>
                    </tr>';
                }
                foreach ($dataSearchUser as $key => $value) {
                    $htmlSearch .= '<tr>
                    <th scope="row">'.$value->id.'</th>
                    <td>'.$value->title.'</td>
                    <td><a href="http://localhost/PHP_Rush_MVC/Webroot/posts/read/'.$value->id.'">[View]</a></td>
                    </tr>';
                }
                foreach ($dataSearchPost as $key => $value) {
                    $htmlSearch .= '<tr>
                    <th scope="row">'.$value->id.'</th>
                    <td>'.$value->title.'</td>
                    <td><a href="http://localhost/PHP_Rush_MVC/Webroot/posts/read/'.$value->id.'">[View]</a></td>
                    </tr>';
                }
            }
            else if($_POST['options'] == 1)
            {
                $dataSearchPost = $searchPost->search($_POST['search']);
                foreach ($dataSearchPost as $key => $value) {
                    $htmlSearch .= '<tr>
                    <th scope="row">'.$value->id.'</th>
                    <td>'.$value->title.'</td>
                    <td><a href="http://localhost/PHP_Rush_MVC/Webroot/posts/read/'.$value->id.'">[View]</a></td>
                    </tr>';
                }
            }
            else if($_POST['options'] == 2)
            {
                $dataSearchUser = $searchUser->search($_POST['search']);
                foreach ($dataSearchUser as $key => $value) {
                    $htmlSearch .= '<tr>
                    <th scope="row">'.$value->id.'</th>
                    <td>'.$value->title.'</td>
                    <td><a href="http://localhost/PHP_Rush_MVC/Webroot/posts/read/'.$value->id.'">[View]</a></td>
                    </tr>';
                }
            }
            else if($_POST['options'] == 3)
            {
                $dataSearchCat = $searchCat->search($_POST['search']);
                foreach ($dataSearchCat as $key => $value) {
                    $htmlSearch .= '<tr>
                    <th scope="row">'.$value->id.'</th>
                    <td>'.$value->title.'</td>
                    <td><a href="http://localhost/PHP_Rush_MVC/Webroot/posts/read/'.$value->id.'">[View]</a></td>
                    </tr>';
                }
            }
        }
        $data['html'] = $htmlSearch;
        $this->render('search/index', $data);
    }
}