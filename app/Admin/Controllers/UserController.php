<?php

namespace App\Admin\Controllers;

use App\models\User;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        /* foreach (User::all() as $key => $u) {
            $now = Carbon::now();
            $joined = $now->subMonth(rand(0, 12));
            $joined = $joined->subDays(rand(0, 45));
            $u->created_at = $joined;
            $u->save();
        } */
        $grid = new Grid(new User());
        $grid->column('id', __('ID'));
        $grid->column('created_at', __('Joined'))->sortable();
        $grid->column('name', __('Name'));
        $grid->column('phone_number', __('Phone Number'));
        $grid->column('email', __('Email'));
        $grid->column('gender', __('Gender'));
        /*
        $grid->column('email_verified_at', __('Email verified at'));
        $grid->column('password', __('Password')); */
        /*
        $grid->column('remember_token', __('Remember token'));
        */
        $grid->column('updated_at', __('Updated at'))->hide();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('phone_number', __('phone number'));
        $show->field('email', __('Email'));
        $show->field('gender', __('Gender'));
        /*         $show->field('email_verified_at', __('Email verified at'));
 */
        $show->field('password', __('Password'));
        /*         $show->field('remember_token', __('Remember token'));
 */
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->text('name', __('Name'));
        $form->text('phone_number', __('phone number'));
        $form->email('email', __('Email'));
        $form->radioCard('gender', __('Gender'))
            ->options([
                'male' => 'male',
                'female' => 'female',

            ]);

        /*         $form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
 */
        $form->password('password', __('Password'));
        $form->text('remember_token', __('Remember token'));


        return $form;
    }
}
