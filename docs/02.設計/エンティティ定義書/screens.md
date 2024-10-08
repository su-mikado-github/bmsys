# 画面 (screens)

## テーブル情報

| 項目                           | 値                                                                                                   |
|:-------------------------------|:-----------------------------------------------------------------------------------------------------|
| システム名                     | 業務管理システム                                                                                     |
| サブシステム名                 |                                                                                                      |
| 物理エンティティ名             | screens                                                                                              |
| 論理エンティティ名             | 画面                                                                                                 |
| 作成者                         | Shuji Ushiyama                                                                                       |
| 作成日                         | 2024/08/24                                                                                           |
| タグ                           |                                                                                                      |



## カラム情報

| No. | 論理名                         | 物理名                         | データ型                       | Not Null | デフォルト           | 備考                           |
|----:|:-------------------------------|:-------------------------------|:-------------------------------|:---------|:---------------------|:-------------------------------|
|   1 | 画面ID                         | id                             | *レコードID                    | Yes (PK) |                      |                                |
|   2 | 画面識別キー                   | screen_key                     | *識別キー                      | Yes      |                      |                                |
|   3 | タイトル                       | name                           | *名称                          |          |                      |                                |
|   4 | タイトル略称                   | short_name                     | *略称                          |          |                      |                                |
|   5 | 画面アイコン                   | icon                           | *アイコン名                    |          |                      |                                |
|   6 | 表示順                         | display_order                  | *順序                          | Yes      | 0                    |                                |
|   7 | 作成日時                       | create_tm                      | *タイムスタンプ                | Yes      | 0                    |                                |
|   8 | 作成者ID                       | create_id                      | *利用者ID（参照）              | Yes      | 0                    |                                |
|   9 | 更新日時                       | update_tm                      | *タイムスタンプ                | Yes      | 0                    |                                |
|  10 | 更新者ID                       | update_id                      | *利用者ID（参照）              | Yes      | 0                    |                                |
|  11 | 削除済フラグ                   | is_deleted                     | *フラグ                        | Yes      | 0                    | 0:未削除 1:削除済み            |
|  12 | 削除日時                       | deleted_tm                     | *タイムスタンプ                |          |                      |                                |
|  13 | バージョン                     | data_version                   | *データ・バージョン            | Yes      | 1                    | 楽観排他用。レコードのバージョン |



## インデックス情報

| No. | インデックス名                 | カラムリスト                             | ユニーク   | オプション                     | 
|----:|:-------------------------------|:-----------------------------------------|:-----------|:-------------------------------|



## リレーションシップ情報

| No. | 動詞句                         | カラムリスト                             | 参照先                         | 参照先カラムリスト                       | ON DELETE    | ON UPDATE    |
|----:|:-------------------------------|:-----------------------------------------|:-------------------------------|:-----------------------------------------|:-------------|:-------------|



## リレーションシップ情報(PK側)

| No. | 動詞句                         | カラムリスト                             | 参照元                         | 参照元カラムリスト                       | ON DELETE    | ON UPDATE    |
|----:|:-------------------------------|:-----------------------------------------|:-------------------------------|:-----------------------------------------|:-------------|:-------------|
|   1 |                                | id                                       | screen_roles                   | screen_id                                |              |              |


