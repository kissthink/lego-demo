<?php

use Lego\Lego;
use Lego\Widget\Grid\Grid;

$filter = Lego::filter(\App\City::class);
$filter->addText('name');
$filter->addDateRange('created_at', '创建时间');
$filter->addDateRange('updated_at', '最后一次更新时间');

$grid = Lego::grid($filter);
$grid->add('id', '操作')->pipe(function ($id) {
    return link_to(route('demo', 'city') . '?id=' . $id, '编辑');
});
$grid->add('name', '名称');
$grid->add('created_at|date', '创建日期');
$grid->after('name')->add('updated_at|time', '更新时间');

$grid->addLeftTopButton('新建城市', route('demo', 'city'));

$grid->export('导出城市列表', function (Grid $grid) {
    $grid->remove('id');
});

return $grid;
