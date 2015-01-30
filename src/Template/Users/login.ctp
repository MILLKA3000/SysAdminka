<style>
    .modal-backdrop.in {
        filter: alpha(opacity=50);
        opacity: .9;
    }
</style>
<div class="modal fade loginModal">
    <div class="modal-dialog">
        <div class="modal-content">
                        <h1 class="text-center login-title">Sign in to continue to SysAdmin</h1>
                        <div class="account-wall">

                            <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                                 alt="">
                            <?= $this->Form->create('user',['class'=>'form-signin']) ?>
                            <?= $this->Flash->render('auth') ?>
                            <?= $this->Flash->render() ?>
                            <?= $this->Form->input('email',['type'=>'text','class'=>'form-control loginfocus','placeholder'=>'email']) ?>
                            <?= $this->Form->input('password',['type'=>'password','class'=>'form-control','placeholder'=>'password']) ?>
                            <br/>
                            <?= $this->Form->button(__('Login'),['class'=>'btn btn-lg btn-primary btn-block']); ?>
                            <?= $this->Form->end() ?>
                            <a href="#"
                               class="pull-right need-help"
                               data-toggle="popover"
                               data-placement="left"
                               data-content="Sign in only for administrator TDMU.   If you have any questions, please contact with administrators."
                               title="Need help?">Need help? </a>
                            <span class="clearfix"></span>
                            </form>
                        </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

    $(function () {
        $('.loginModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('[data-toggle="popover"]').popover()
    })
</script>