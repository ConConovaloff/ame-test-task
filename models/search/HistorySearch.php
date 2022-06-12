<?php

namespace app\models\search;

use app\models\History;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * HistorySearch represents the model behind the search form about `app\models\History`.
 *
 * @property array $objects
 */
class HistorySearch extends History
{
    /** @var string */
    public $ins_ts_from;

    /** @var string */
    public $ins_ts_to;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id'], 'each', 'rule' => ['integer']],
            [['user_id'], 'integer'],
            [['ins_ts_from', 'ins_ts_to'], 'date', 'format' => 'yyyy-mm-dd'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = History::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'defaultOrder' => [
                'ins_ts' => SORT_DESC,
                'id' => SORT_DESC
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        // В будущем будет большое количество данных в истории.
        // Чтобы менеджеры могли выгружать эти данные, их нужно лимитировать через удобный для них фильтр
        $query
            ->andFilterWhere(['user_id' => $this->user_id])
            ->andFilterWhere(['event_id' => $this->event_id])
            ->andFilterWhere(['>', 'ins_ts', $this->ins_ts_from])
            ->andFilterWhere(['<', 'ins_ts', $this->ins_ts_to])
        ;

        $query->with($this->getAllObjectRelation());

        return $dataProvider;
    }
}
