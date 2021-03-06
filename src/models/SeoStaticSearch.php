<?php

namespace drtsb\yii\seo\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SeoStaticSearch represents the model behind the search form of `drtsb\yii\seo\models\SeoStatic`.
 */
class SeoStaticSearch extends SeoStatic
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'meta_noindex', 'meta_nofollow'], 'integer'],
            [['controller', 'action', 'meta_title', 'meta_description', 'meta_keywords', 'rel_canonical'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = SeoStatic::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'meta_noindex' => $this->meta_noindex,
            'meta_nofollow' => $this->meta_nofollow,
        ]);

        $query->andFilterWhere(['like', 'controller', $this->controller])
            ->andFilterWhere(['like', 'action', $this->action])
            ->andFilterWhere(['like', 'meta_title', $this->meta_title])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description])
            ->andFilterWhere(['like', 'meta_keywords', $this->meta_keywords])
            ->andFilterWhere(['like', 'rel_canonical', $this->rel_canonical]);

        return $dataProvider;
    }
}
