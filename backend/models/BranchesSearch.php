<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\branches;

/**
 * BranchesSearch represents the model behind the search form of `backend\models\branches`.
 */
class BranchesSearch extends branches
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['branch_id'], 'integer'],
            [['branch_name', 'branch_address', 'branch_created', 'branch_status', 'companies_company_id'], 'safe'],
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
        $query = branches::find();

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

        $query->joinwith('companiesCompany');



        // grid filtering conditions
        $query->andFilterWhere([
            'branch_id' => $this->branch_id,
            // 'companies_company_id' => $this->companies_company_id,
            'branch_created' => $this->branch_created,
        ]);

        $query->andFilterWhere(['like', 'branch_name', $this->branch_name])
            ->andFilterWhere(['like', 'branch_address', $this->branch_address])
            ->andFilterWhere(['like', 'branch_status', $this->branch_status])
            ->andFilterWhere(['like', 'Companies.company_name', $this->companies_company_id]);

        return $dataProvider;
    }
}
