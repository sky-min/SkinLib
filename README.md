# SkinTool
pmmp virion

# API
## 이미지 불러오기
```php
SkinTool::getInstance()->getImg($path);
```
해당 경로에 있는 이미지를 가져옵니다. 이미지가 없을경우 null로 반환됩니다.
## 이미지 저장하기
```php
SkinTool::getInstance()->saveImg($image, $path);
```
얻은 이미지나 수정한 이미지를 저장할때 사용합니다. 동일명의 파일이 있을 경우 오류가 납니다. 주의하여 사용해 주세요.
## 이미지 합치기
```php
SkinTool::getInstance()->mergeImage($image1, $image2);
```
	2개의 이미지를 합칩니다. 이미지크기가 스킨에 사용할 수 없는 사이즈이면 null로 반환됩니다.
## 이미지 스킨데이터로 변환
```php
SkinTool::getInstance()->getSkinData($image);
```
이미지크기가 스킨에 사용할 수 없는 사이즈이면 null로 반환됩니다.
## 스킨데이터로 이미지 불러오기
```php
SkinTool::getInstance()->dataToImage($skinData);
```
스킨데이터크기가 아닐 경우 null로 반환됩니다.
## 모델링 합성하기
```php
SkinTool::getInstance()->mergeModel($model1, $model2, $type);
```
$type에는 SkinTool::PATH와 SkinTool::JSON 중 상황에 맞게 입력하세요. SkinTool::JSON은 기본값으로 지정되어 있습니다.

$type에 따라 $model1과 $model2에 넣어야 할 값이 다름니다.

SkinTool::JSON 일 경우 $model1과 $model2에 모델링 json 내용을 넣어줘야합니다

SkinTool::PATH일 경우 $model1과 $model2에 파일경로를 넣어주면 됩니다.