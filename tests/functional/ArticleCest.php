<?php

namespace drtsb\yii\seo\tests\functional;

use app\models\PureArticle;
use drtsb\yii\seo\tests\FunctionalTester;

class ArticleCest
{
    public function checkDataClosureValuesAtForm(FunctionalTester $I)
    {
        $I->wantTo('see form fields filled with values generated by dataClosure');

        $model = new PureArticle(['title' => 'Some Article']);

        $model->save();

        $I->amOnRoute('article/update', ['id' => $model->primaryKey]);

        $I->seeInField(['name' => 'SeoModel[meta_title]'], 'Some Article Title');
        $I->seeInField(['name' => 'SeoModel[meta_description]'], 'Some Article Description');
        $I->seeInField(['name' => 'SeoModel[meta_keywords]'], 'Some Article Keywords');
        $I->seeCheckboxIsChecked('#seomodel-meta_noindex');
        $I->seeCheckboxIsChecked('#seomodel-meta_nofollow');
    }
}
