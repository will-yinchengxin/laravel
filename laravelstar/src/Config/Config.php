<?php
namespace LaravelStar\Config;

class Config
{
    protected $itmes = [];

    /**
     * 读取PHP文件类型的配置文件
     */
    public function phpParser($configPath)
    {
        // 1. 找到文件
        // 此处跳过多级的情况
        $files = scandir($configPath);
        $data = null;
        // 2. 读取文件信息
        foreach ($files as $key => $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            // 2.1 获取文件名
            $filename = \stristr($file, ".php", true);
            // 2.2 读取文件信息
            $data[$filename] = include $configPath."/".$file;
        }

        // 3. 结果
        $this->itmes = $data;
        return $this;
    }
    // key.key2.key3
    public function get($keys)
    {
        $data = $this->itmes;
        foreach (\explode('.', $keys) as $key => $value) {
            $data = $data[$value];
        }
        return $data;
    }

    public function all()
    {
        return $this->itmes;
    }
}
