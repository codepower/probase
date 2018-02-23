
<div class="page-title">会员列表</div>
<div class="page-header">
    <a href="/member/new" class="button primary">新建</a>
    <span> </span>
    <a href="/member/index" class="button primary">返回</a>
</div>
    <table class="bordered no-padding">
        <thead>
            <tr>
                <th>编号</th>
                <th>手机</th>
                <th>邮箱</th>
                <th>头像</th>
                <th>昵称</th>
                <th>最近登录</th>
                <th>登录IP</th>
                <th>注册时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        <?php if (isset($page->items)) { ?>
        <?php foreach ($page->items as $member) { ?>
            <tr>
                <td class="align-right"><?= $member->memberId ?></td>
                <td style="text-align:center;"><?= $member->mobile ?></td>
                <td class="align-left"><?= $member->email ?></td>
                <td style="text-align:center;width:80px;"><img class="square-thumb-small"  src="<?php echo "http://lc.zyw68.com/upload/avatar/icon".$member->memberId.".jpg";?>" /></td>
                <td class="align-left"><?= $member->nickname ?></td>
                <td class="align-center"><?= date('Y.m.d H:i:s', $member->lastLogin) ?></td>
                <td class="align-center"><?= $member->loginIp ?></td>
                <td class="align-center"><?= date('Y.m.d H:i:s', $member->registerTime) ?></td>
                <td style="text-align:center;">
                    <a href="/member/edit/<?=$member->memberId?>" class="small-button edit">编辑</a>
                    <a href="/member/delete/<?=$member->memberId?>" class="small-button delete">删除</a>
                </td>
            </tr>
        <?php } ?>
        <?php } ?>
        </tbody>
    </table>

<div class="pagination">
    <?= $this->tag->linkTo(['member/search', '首页']) ?>
    <?= $this->tag->linkTo(['member/search?page=' . $page->before, '上一页']) ?>
    <span><?= $page->current . '/' . $page->total_pages ?></span>
    <?= $this->tag->linkTo(['member/search?page=' . $page->next, '下一页']) ?>
    <?= $this->tag->linkTo(['member/search?page=' . $page->last, '尾页']) ?>
</div>
