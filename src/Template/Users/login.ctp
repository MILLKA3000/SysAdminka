<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Sign in to continue to SysAdmin</h1>
            <div class="account-wall">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                     alt="">
                    <?= $this->Form->create('user',['class'=>'form-signin']) ?>
                    <?= $this->Flash->render('auth') ?>

                    <?= $this->Form->input('email',['type'=>'text','class'=>'form-control','placeholder'=>'email']) ?>
                    <?= $this->Form->input('password',['type'=>'password','class'=>'form-control','placeholder'=>'password']) ?>
                        <br/>
                        <?= $this->Form->button(__('Login'),['class'=>'btn btn-lg btn-primary btn-block']); ?>
                        <?= $this->Form->end() ?>
                    <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                </form>
            </div>
        </div>
    </div>
</div>