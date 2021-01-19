## laravel扩展组件开发指南

## 创建应用包

目录结构如下

    |---application     //应用包
        |----admin      //后台
        |----api        //接口
            |----src        
                |----Controllers        //控制器
                |----Logic              //逻辑层
                |----Providers          //服务提供者
            |----routes     //路由
            |----config     //配置
        |----dataset    //数据集
            |----database
                |----migrations         //数据迁移
                |----factories          //模型工厂
                |----seeds              //数据填充器
            |----src
                |----Collection         //对象集合
                |----Models             //模型
        |----sdk                        //sdk
            |----src
            |----test                   //单元测试
            
> 每一个一级目录的业务级别应用都必须带有服务提供者，最好每个应用都能有
            
## 