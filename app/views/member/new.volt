<div class="page-header">
    <div class="page-title">新建成员</div>
</div>

<div class="page-body">
<form action="/member/create" method="post" autocomplete="off" class="aligned">
<div class="form-group">
    <label for="fieldMobile" class="control-label">Mobile</label>
    <div>
        {{ text_field("mobile", "size":30, "class" : "form-control", "id" : "fieldMobile") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldEmail" class="control-label">Email</label>
    <div>
        {{ text_field("email", "size" : 30, "class" : "form-control", "id" : "fieldEmail") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldAvatar" class="control-label">Avatar</label>
    <div>
        {{ text_field("avatar", "size" : 30, "class" : "input form-control", "id" : "fieldAvatar") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldNickname" class="control-label">Nickname</label>
    <div>
        {{ text_field("nickname", "size" : 30, "class" : "input form-control", "id" : "fieldNickname") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldLastlogin" class="control-label">LastLogin</label>
    <div>
        {{ text_field("lastLogin", "type" : "numeric", "class" : "form-control", "id" : "fieldLastlogin") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldLoginip" class="control-label">LoginIp</label>
    <div>
        {{ text_field("loginIp", "size" : 30, "class" : "form-control", "id" : "fieldLoginip") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldRegistertime" class="control-label">RegisterTime</label>
    <div>
        {{ text_field("registerTime", "type" : "numeric", "class" : "form-control", "id" : "fieldRegistertime") }}
    </div>
</div>


<div class="form-group">
    <button class="primary">提交</button>
</div>

</form>
</div>
