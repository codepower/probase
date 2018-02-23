<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("member", "返回") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Edit member
    </h1>
</div>

{{ content() }}

{{ form("member/save", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldMobile" class="col-sm-2 control-label">Mobile</label>
    <div class="col-sm-10">
        {{ select_static("mobile", "using": [], "class" : "form-control", "id" : "fieldMobile") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldEmail" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
        {{ text_field("email", "size" : 30, "class" : "form-control", "id" : "fieldEmail") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldPassword" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
        {{ select_static("password", "using": [], "class" : "form-control", "id" : "fieldPassword") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldEncrypt" class="col-sm-2 control-label">Encrypt</label>
    <div class="col-sm-10">
        {{ select_static("encrypt", "using": [], "class" : "form-control", "id" : "fieldEncrypt") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldAvatar" class="col-sm-2 control-label">Avatar</label>
    <div class="col-sm-10">
        {{ text_field("avatar", "size" : 30, "class" : "form-control", "id" : "fieldAvatar") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldNickname" class="col-sm-2 control-label">Nickname</label>
    <div class="col-sm-10">
        {{ text_field("nickname", "size" : 30, "class" : "form-control", "id" : "fieldNickname") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldQqtoken" class="col-sm-2 control-label">QqToken</label>
    <div class="col-sm-10">
        {{ select_static("qqToken", "using": [], "class" : "form-control", "id" : "fieldQqtoken") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldWxtoken" class="col-sm-2 control-label">WxToken</label>
    <div class="col-sm-10">
        {{ select_static("wxToken", "using": [], "class" : "form-control", "id" : "fieldWxtoken") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldLastlogin" class="col-sm-2 control-label">LastLogin</label>
    <div class="col-sm-10">
        {{ text_field("lastLogin", "type" : "numeric", "class" : "form-control", "id" : "fieldLastlogin") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldLoginip" class="col-sm-2 control-label">LoginIp</label>
    <div class="col-sm-10">
        {{ text_field("loginIp", "size" : 30, "class" : "form-control", "id" : "fieldLoginip") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldRegistertime" class="col-sm-2 control-label">RegisterTime</label>
    <div class="col-sm-10">
        {{ text_field("registerTime", "type" : "numeric", "class" : "form-control", "id" : "fieldRegistertime") }}
    </div>
</div>


{{ hidden_field("id") }}

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Send', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
