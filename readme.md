## 环境
- php >= 7.2

- mysql >= 5.6

- nginx composer node
## 后端
- 框架：Laravel 6.x [文档](https://learnku.com/docs/laravel/6.x)

- 权限rbac：基于laravel-permission [文档](https://docs.spatie.be/laravel-permission/v3/basic-usage/role-permissions/)

- 面包屑导航：基于laravel-breadcrumbs [github](https://github.com/davejamesmiller/laravel-breadcrumbs)

## 前端
- 框架：AdminLte v3 [文档](https://adminlte.io/docs/3.0/index.html)

- Bootstrap v4 [文档](https://getbootstrap.com/docs/4.3/getting-started/introduction/)


## 安装

```
//克隆项目
git clone https://github.com/niwota/Lara-Admin.git

cd Lara-Admin

//安装后端依赖
composer install

cp .env.example .env

php artisan key:generate  

//配置好数据库后做数据迁移
php artisan migrate

php artisan db:seed

//存储文件软链接
php artisan storage:link 

//安装前端依赖
npm install

//编译js css
npm run dev/watch/prod

//配置好host,nginx后就可以直接访问了
//账号：admin
//密码：admin 

```

## 目的
- 抛砖引玉，希望有大神给出更棒更好的建议

- 给有需要的朋友创造一个专注主业务的干净的后台管理系统

- 也是给自己一段时间的编码做一些总结

## 注意事项
- composer最稳的中国镜像 [看这里](https://developer.aliyun.com/composer)

- 设置权限的时候要和路由名保持一致，权限才能生效
