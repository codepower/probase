<div class="page-header">
    <h1>
        Search ab_member
    </h1>
    <p>
        {{ link_to("member/new", "添加") }}
    </p>
</div>

{{ content() }}

{{ form("ab_member/search", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldMemberid" class="col-sm-2 control-label">MemberId</label>
    <div class="col-sm-10">
        {{ text_field("memberId", "type" : "numeric", "class" : "form-control", "id" : "fieldMemberid") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldMobile" class="col-sm-2 control-label">Mobile</label>
    <div class="col-sm-10">
        {{ text_field("mobile", "type" : "numeric", "class" : "form-control", "id" : "fieldMobile") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldEmail" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
        {{ text_field("email", "size" : 30, "class" : "form-control", "id" : "fieldEmail") }}
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


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Search', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
