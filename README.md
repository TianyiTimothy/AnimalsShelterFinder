# Animals Shelter Finder

Show pets that need a home.

Get pets' location from [Pet Finder API](https://www.petfinder.com/developers/) and display the location in [Google Map](https://cloud.google.com/maps-platform/).



## APIs

**Pet Finder** <https://www.petfinder.com/developers/>

​	-- It shows data of pets that need an owner

**Google Map** <<https://cloud.google.com/maps-platform/>>

​	-- A map API



## Project Status

Initializing-----------

done------------------

来康康图片效果吧！or you can request for your own API keys(there are links above) to deploy this project.

**Login.php**: You need to login first, to track those who wastes my API usages.😄😄😄😄

![image-20200425002222348](C:\Users\41604\AppData\Roaming\Typora\typora-user-images\image-20200425002222348.png)

**List.php**: Showing all the animals return from the PetFinder API.

![image-20200425000509071](C:\Users\41604\AppData\Roaming\Typora\typora-user-images\image-20200425000509071.png)

Detail.php: Showing details of one pet. The picture is deployed in a carousel rendering.

![image-20200425000447830](C:\Users\41604\AppData\Roaming\Typora\typora-user-images\image-20200425000447830.png)

map.php: Showing shelters on Google Map. (其实还没整明白咋用 哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈)

![image-20200425002356181](C:\Users\41604\AppData\Roaming\Typora\typora-user-images\image-20200425002356181.png)

不知道这些图片能不能正常上传到github上啊 试试看

## GitIgnore

Ignored all the keys. 

keys/keys.php

```php
<?php
$GMP_API_KEY = "YOUR_GOOGLEMAP_KEYS";
$PFD_API_KEY = "YOUR_PETFINDER_KEYS";
$PFD_SEC = "YOUR_PETFINDER_SECRET";
$GSI_CLIENT_ID = "..";
$GSI_CLIENT_SECRET = "..";
```



## Acknowledgments

- [Nithya](<https://github.com/nithyat>) who gave me instruction when I am stuck in PHP.

- [Christine](<https://github.com/christinebittle>) who taught me how to think like a programmer.

- Sean who Provided all the information about writing a README.md file.

- Joanna who showed me the way using an API.

- Bernie who spared no effort to guide the paper work.

  👆Shout out to my professors at Humber College!👆
