<?php

class Admin extends Controller
{
    public function index()
    {
        Controller::pageRole(2);
        $data = $this->indexPosts();
        $this->render('admin/index', $data);
    }

    public function edit()
    {
        Controller::pageRole(2);
        $alert = '';
        $data = $_SESSION;

        if(isset($_POST['username']))
        {
            if(!$this->isValidEmail($_POST['email']))
            {
                $alert = '<div class="alert alert-warning"><strong>Warning!</strong> Email.</div>';
            }
            else if($_POST['password'] != $_POST['confirm'])
            {
                $alert = '<div class="alert alert-warning"><strong>Warning!</strong> Mot de passe.</div>';
            }
            else
            {
                $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $username = $this->secure_input($_POST['username']);
                $email = $this->secure_input($_POST['email']);
                
                $data = [
                    'username' => $username,
                    'password' => $hash,
                    'email' => $email,
                    'userGroup' => $_POST['userGroup'], 
                    'status' => $_POST['status'],
                    'id' => $_SESSION['id']
                ];
                

                $user = $this->loadModel('MUsers');

                $user->update($data);  
                Session::init($data);
                $alert = '<div class="alert alert-success"><strong>Succès!</strong> Utilisateur ajouté avec succès.</div>';
            
            }
            
        }

        $data['alert'] = $alert;
        $this->render('admin/edit', $data);
    }

    public function users()
    {
        Controller::pageRole(2);
        $htmlList = '';
        $user = $this->loadModel('Musers');
        $data = $user->get();
        foreach ($data as $key => $value) {
            if($value->userGroup == 0)
            {
                $userGroup = 'User';
            } else if($value->userGroup == 1)
            {
                $userGroup = 'Writer';
            } else if($value->userGroup == 2)
            {
                $userGroup = 'Admin';
            }
            $status = $value->status ? 'Banned' : 'On';
            $htmlList .= '<tr>
            <td>'.$value->username.'</td>
            <td>'.$value->email.'</td>
            <td>'.$userGroup.'</td>
            <td>'.$status.'</td>
            <td><a href="edituser/'.$value->id.'">Edit</a></td>
            <td><a href="delete/'.$value->id.'">Delete</a></td>
            </tr>';
        }
        $data['htmlList'] = $htmlList;
        $this->render('admin/listUsers', $data);
    }

    public function delete($id)
    {
        Controller::pageRole(2);
        $user = $this->loadModel('Musers');
        $user->delete($id);
        Controller::redirect(['admin','users']);
    }

    public function edituser($id)
    {
        Controller::pageRole(2);
        $alert = '';
        $user = $this->loadModel('MUsers');

        if(isset($_POST['username']))
        {
            if(!$this->isValidEmail($_POST['email']))
            {
                $alert = '<div class="alert alert-warning"><strong>Warning!</strong> Email.</div>';
            }
            else if($_POST['password'] != $_POST['confirm'])
            {
                $alert = '<div class="alert alert-warning"><strong>Warning!</strong> Mot de passe.</div>';
            }
            else
            {
                $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $username = $this->secure_input($_POST['username']);
                $email = $this->secure_input($_POST['email']);
                
                $data = [
                    'username' => $username,
                    'password' => $hash,
                    'email' => $email,
                    'userGroup' => $_POST['userGroup'], 
                    'status' => $_POST['status'],
                    'id' => $id
                ];
                
                $user->update($data);  
                Session::init($data);
                Controller::redirect(['admin','users']);
                $alert = '<div class="alert alert-success"><strong>Succès!</strong> Updata avec succès.</div>';
            }
        }
        
        $data = $user->get($id);

        if($data['userGroup'] == 0)
            {
                $htmlGroup = '
        <option value="2">Admin</option>
        <option value="1">Writer</option>
        <option value="0" selected>User</option>';
            } 
            else if($data['userGroup'] == 1)
            {
                $htmlGroup = '
        <option value="2">Admin</option>
        <option value="1" selected>Writer</option>
        <option value="0">User</option>';
            } 
            else if($data['userGroup'] == 2)
            {
                $htmlGroup = '
        <option value="2" selected>Admin</option>
        <option value="1">Writer</option>
        <option value="0">User</option>';
            }
        
        if($data['status'])
        {
            $htmlStatus = '<option value="0">Not banned</option>
                <option value="1" selected>Banned</option>';
        }
        else
        {
            $htmlStatus = '<option value="0" selected>Not banned</option>
                <option value="1">Banned</option>';
        }
        $data['htmlGroup'] = $htmlGroup;
        $data['htmlStatus'] = $htmlStatus;
        $data['alert'] = $alert;
        $this->render('admin/editUser', $data);
    }

    public function categories()
    {
        $data = '';
        Controller::pageRole(2);
        $htmlList = '';
        $categories = $this->loadModel('MCategories');
        $data = $categories->get();
        foreach ($data as $key => $value) {
            $htmlList .= '<tr>
            <td>'.$value->id.'</td>
            <td>'.$value->name.'</td>
            <td><a href="editCategory/'.$value->id.'">Edit</a></td>
            <td><a href="deleteCategory/'.$value->id.'">Delete</a></td>
            </tr>';
        }
        $data['htmlList'] = $htmlList;
        $this->render('admin/categories', $data);
    }

    public function deleteCategory($id)
    {
        Controller::pageRole(2);
        $categories = $this->loadModel('MCategories');
        $posts = $this->loadModel('MPosts');
        $categories->delete($id);
        $posts->updateAfterCatDelete($id);
        Controller::redirect(['admin', 'categories']);
    }

    /*------------------------CATEGORIES----------------------------*/

    public function addCategory()
    {
        Controller::pageRole(2);
        $alert = "";
        if(isset($_POST['name']) && $_POST['name'] != null)
        {
            $CategoryName = $this->secure_input($_POST['name']);
            $data = [
                'name' => $CategoryName
            ];

            $Category = $this->loadModel('Mcategories');
            $Category->create($data);
            Controller::redirect(['admin', 'categories']);
        }
        $data['alert'] = $alert;
        $this->render('admin/addCategory');
    }

    public function editCategory($id)
    {
        Controller::pageRole(2);
        if($id == null)
        {
            Controller::redirect(['posts', 'admin']);
        }
        else
        {
            $alert = '';
            $category = $this->loadModel('Mcategories') ;
            if(isset($_POST['name']))
            {
                $categoryName = $this->secure_input($_POST['name']);
                $data = [
                    'name' => $categoryName
                ];

                $category->update($data, $id);
                Controller::redirect(['admin', 'categories']);
            }
            $data = $category->get($id);
            //$data['name'] = $CategoryName;
            $data['alert'] = "";
        
            $this->render('admin/editCategory', $data);
        }
    }
}