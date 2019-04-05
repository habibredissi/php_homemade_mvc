<?php

class Comments extends Controller
{
    public function index()
    {
        Controller::pageRole(1);

        $comments = $this->loadModel('MComment');
        $posts = $this->loadModel('MPosts');
        $htmlList = '';

        if($_SESSION['userGroup'] == 2) // Admin
        {
            $data = $comments->get();
            foreach ($data as $key => $value) {
                $htmlList .= '<tr>
                <td>'.$value->id.'</td>
                <td>'.$value->content.'</td>
                <td><a href="delete/'.$value->id.'">Delete</a></td>
                </tr>';
            }
        }
        else // Writer
        {
            $data = $comments->getCommentsByAuthorID($_SESSION['id']);
            foreach ($data as $key => $value) {
                $htmlList .= '<tr>
                <td>'.$value->id.'</td>
                <td>'.$value->content.'</td>
                <td><a href="delete/'.$value->id.'">Delete</a></td>
                </tr>';
            }
        }
        $data['htmlList'] = $htmlList;
        $this->render('comments/index', $data);
    }

    public function delete($id)
    {
        $comments = $this->loadModel('MComment');
        $comments->delete($id);
        Controller::redirect(['comments','index']);
    }
}