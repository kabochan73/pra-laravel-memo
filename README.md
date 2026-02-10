# Laravel メモアプリ

シンプルなメモ管理アプリケーションです。メモの作成・一覧表示・編集・削除・検索ができます。

## 機能一覧

- メモの作成・編集・削除（CRUD）
- メモの一覧表示（新しい順）
- キーワード検索（タイトル・本文）
- ページネーション

## 技術スタック

- PHP / Laravel
- MySQL 8.0
- Nginx
- Docker / Docker Compose
- Tailwind CSS（CDN）

## セットアップ

### 1. リポジトリをクローン

```bash
git clone <リポジトリURL>
cd laravel-memo
```

### 2. 環境変数ファイルを作成

```bash
cp src/.env.example src/.env
```

### 3. Docker コンテナを起動

```bash
docker compose up -d
```

### 4. アプリケーションの初期設定

```bash
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
```

### 5. アクセス

ブラウザで http://localhost:8080 にアクセスしてください。
