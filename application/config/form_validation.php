<?php

$config = array(
        //rules for login form
        'login' => array(
                array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'trim|required|valid_email|max_length[255]'
                ),
                array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'trim|required|min_length[4]|max_length[255]'
                )
        ),

        //rules for creating user
        'createUserAccount' => array(
                array(
                        'field' => 'rname',
                        'label' => 'Name',
                        'rules' => 'trim|required|min_length[4]|max_length[255]'
                ),
                array(
                        'field' => 'remail',
                        'label' => 'Email',
                        'rules' => 'trim|required|valid_email|max_length[255]|is_unique[users.email]'
                ),
                array(
                        'field' => 'rpassword',
                        'label' => 'Password',
                        'rules' => 'trim|required|min_length[4]|max_length[255]|matches[passconf]'
                ),
                array(
                        'field' => 'passconf',
                        'label' => 'Password Confirmation',
                        'rules' => 'trim|required|min_length[4]|max_length[255]|matches[rpassword]'
                ),
                array(
                        'field' => 'contact_no',
                        'label' => 'Contact',
                        'rules' => 'trim|required|min_length[7]|max_length[16]'
                ),
                array(
                        'field' => 'address',
                        'label' => 'Address',
                        'rules' => 'trim|required|min_length[3]|max_length[255]'
                ),
                array(
                        'field' => 'code',
                        'label' => 'Refferal Code',
                        'rules' => 'trim|required|min_length[10]|max_length[255]'
                )
        ),
        
        //rules for editing user
        'editUserAccount' => array(
                array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required|max_length[255]'
                ),
                array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'trim|required|valid_email|max_length[255]'
                ),
                array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'trim|min_length[4]|max_length[255]|matches[passconf]'
                ),
                array(
                        'field' => 'passconf',
                        'label' => 'Password Confirmation',
                        'rules' => 'trim|min_length[4]|max_length[255]|matches[password]'
                ),
                array(
                        'field' => 'contact_no',
                        'label' => 'Contact',
                        'rules' => 'trim|min_length[7]|max_length[16]'
                ),
                array(
                        'field' => 'address',
                        'label' => 'Address',
                        'rules' => 'trim|min_length[3]|max_length[255]'
                ),
                array(
                        'field' => 'verification_id',
                        'label' => 'Verification ID',
                        'rules' => 'trim|min_length[8]|max_length[255]'
                )

        ),

        'search' => array(
                array(
                        'field' => 'search',
                        'label' => 'Search',
                        'rules' => 'trim|required'
                )
        ),

        //rules for creating user
        'createAdmin' => array(
                array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required|min_length[4]|max_length[255]'
                ),
                array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'trim|required|valid_email|max_length[255]|is_unique[admins.email]'
                ),
                array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'trim|min_length[4]|max_length[255]|matches[passconf]'
                ),
                array(
                        'field' => 'passconf',
                        'label' => 'Password Confirmation',
                        'rules' => 'trim|min_length[4]|max_length[255]|matches[password]'
                )
        ),

        //rules for editing admin
        'editAdmin' => array(
                array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required|max_length[255]'
                ),
                array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'trim|required|valid_email|max_length[255]'
                ),
                array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'trim|min_length[4]|max_length[255]|matches[password_confirm]'
                ),
                array(
                        'field' => 'password_confirm',
                        'label' => 'Password Confirmation',
                        'rules' => 'trim|min_length[4]|max_length[255]|matches[password]'
                )
        ),

        //rules for adding category
        'addCategory' => array(
                array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required|is_unique[categories.name]'
                )
        ),

        //rules for adding category
        'addBlogCategory' => array(
                array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required|is_unique[blog_categories.name]'
                )
        ),

        //rules for adding tag
        'addTag' => array(
                array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required|is_unique[tags.name]'
                )
        ),

        //rules for uploading product
        'uploadProduct' => array(
                array(
                        'field' => 'name',
                        'label' => 'Title',
                        'rules' => 'trim|required|max_length[255]'
                ),
                array(
                        'field' => 'description',
                        'label' => 'Description',
                        'rules' => 'trim|required'
                ),
                array(
                        'field' => 'category',
                        'label' => 'Category',
                        'rules' => 'trim|required'
                ),
                //array(
               //         'field' => 'std_price',
               //         'label' => 'Standard license price',
              //          'rules' => 'greater_than_equal_to[1]|less_than_equal_to[500]|trim|required'
               // ),
                array(
                        'field' => 'tags[]',
                        'label' => 'Tag',
                        'rules' => 'trim|required'
                )
        ),

        //rules for uploading product in exhibition
        'uploadExhibitionProduct' => array(
                array(
                        'field' => 'name',
                        'label' => 'Title',
                        'rules' => 'trim|required|min_length[4]|max_length[255]'
                ),
                array(
                        'field' => 'description',
                        'label' => 'Description',
                        'rules' => 'trim|required'
                ),
                array(
                        'field' => 'category',
                        'label' => 'Category',
                        'rules' => 'trim|required'
                ),
                array(
                        'field' => 'cr_price',
                        'label' => 'Copyright license price',
                        'rules' => 'greater_than_equal_to[1]|trim|required'
                ),
                array(
                        'field' => 'tags[]',
                        'label' => 'Tag',
                        'rules' => 'trim|required'
                )
        ),

        //rules for uploading blog
        'postBlog' => array(
                array(
                        'field' => 'title',
                        'label' => 'Title',
                        'rules' => 'trim|required|max_length[255]'
                ),
                array(
                        'field' => 'category',
                        'label' => 'Category',
                        'rules' => 'trim|required|max_length[255]'
                ),
                array(
                        'field' => 'body',
                        'label' => 'Body',
                        'rules' => 'trim|required'
                )
        ),

        //rules for package
        'createPackage' => array(
                array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required|max_length[255]'
                ),
                array(
                        'field' => 'price',
                        'label' => 'Price',
                        'rules' => 'trim|required|numeric|greater_than_equal_to[0]'
                ),
                array(
                        'field' => 'quantity',
                        'label' => 'Quantity',
                        'rules' => 'trim|required|numeric[255]|greater_than_equal_to[0]'
                ),
                array(
                        'field' => 'profit_percentage',
                        'label' => 'Profit percentage',
                        'rules' => 'trim|required|numeric|greater_than_equal_to[0]'
                ),
        ),

        //rules for enhance license
        'createEnhanceLicense' => array(
                array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required|max_length[255]'
                ),
                array(
                        'field' => 'price',
                        'label' => 'Price',
                        'rules' => 'trim|required|numeric|greater_than_equal_to[0]'
                ),
                array(
                        'field' => 'quantity',
                        'label' => 'Quantity',
                        'rules' => 'trim|required|numeric[255]|greater_than_equal_to[0]'
                ),
        ),

        'createRegularLicense' => array(
                array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required|max_length[255]'
                ),
                array(
                        'field' => 'price',
                        'label' => 'Price',
                        'rules' => 'trim|required|numeric|greater_than_equal_to[0]'
                ),
                array(
                        'field' => 'quantity',
                        'label' => 'Quantity',
                        'rules' => 'trim|required|numeric[255]|greater_than_equal_to[0]'
                ),
        ),

        //rules for making contact
        'postContact' => array(
                array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required|max_length[255]'
                ),
                array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'trim|required|valid_email|max_length[255]'
                ),
                array(
                        'field' => 'subject',
                        'label' => 'Subject',
                        'rules' => 'trim|required|max_length[255]'
                ),
                array(
                        'field' => 'body',
                        'label' => 'Body',
                        'rules' => 'trim|required'
                )
        ),

        'sendForgotPassword' => array(
                array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'trim|required|valid_email|max_length[255]'
                )
        ),

        'saveNewPassword' => array(
                array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'trim|min_length[4]|max_length[255]|matches[passconf]'
                ),
                array(
                        'field' => 'passconf',
                        'label' => 'Password Confirmation',
                        'rules' => 'trim|min_length[4]|max_length[255]|matches[password]'
                )
        ),
        //rules for reply message to user
        'replyMessage' => array(
                array(
                        'field' => 'subject',
                        'label' => 'Subject',
                        'rules' => 'trim|required|max_length[255]'
                ),
                array(
                        'field' => 'message',
                        'label' => 'Message',
                        'rules' => 'trim|required'
                )
        ),

        //rules for reply message to user
        'settings' => array(
                array(
                        'field' => 'facebook',
                        'label' => 'Facebbok',
                        'rules' => 'trim|required|max_length[255]'
                ),
                array(
                        'field' => 'twitter',
                        'label' => 'Twitter',
                        'rules' => 'trim|required|max_length[255]'
                ),
                array(
                        'field' => 'instagram',
                        'label' => 'Instagram',
                        'rules' => 'trim|required|max_length[255]'
                ),
                array(
                        'field' => 'youtube',
                        'label' => 'Youtube',
                        'rules' => 'trim|required|max_length[255]'
                ),
                array(
                        'field' => 'support_no',
                        'label' => 'Support No',
                        'rules' => 'trim|required|max_length[20]'
                ),
        ),

        //rules for updating banner
        'updateBanner' => array(
                array(
                        'field' => 'header',
                        'label' => 'Header',
                        'rules' => 'trim|required|max_length[255]'
                ),
                array(
                        'field' => 'footer',
                        'label' => 'Footer',
                        'rules' => 'trim|required|min_length[1]'
                ),
        ),

        //rules for money withdraw history insert
        'postWithdraw' => array(
                array(
                        'field' => 'author_id',
                        'label' => 'Author',
                        'rules' => 'trim|required'
                ),
                array(
                        'field' => 'amount',
                        'label' => 'Amount',
                        'rules' => 'trim|required|greater_than_equal_to[500]'
                ),
        ),

);