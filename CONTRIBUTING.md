# Change workflow: local → pull request → approve → live

`main` is protected. Changes reach https://powerco.free.nf only through a pull request and an approved deploy.

## 1. Edit locally
1. In VS Code, open **Source Control** (Ctrl+Shift+G). Switch to `main` and **Pull**.
2. Create a branch: click the branch name (bottom-left) → **Create new branch** → e.g. `feature/hero-text`.
3. Edit theme files in `wp-content/themes/powerco/` and check at http://localhost/wordpress-web.

## 2. Commit and push
1. In **Source Control**, write a message and click **Commit**.
2. Click **Publish Branch** (first time) or **Sync Changes**.

## 3. Pull request
1. On GitHub, click **Compare & pull request** (or **Pull requests → New**), base `main` ← your branch.
2. Wait for **PR check** to pass (PHP syntax check).
3. Review **Files changed**, then **Merge pull request**.

## 4. Approve the deploy
1. Merging starts **Deploy theme to live site**, which waits at **Review deployments**.
2. Open **Actions** → the run → **Review deployments** → tick **production** → **Approve and deploy**.
3. Check https://powerco.free.nf (Ctrl+F5).

## Notes
- Only theme code deploys. Page text, menus and Customizer settings live in the database: edit them in the live site's wp-admin.
- A Customizer value on the live site overrides the default in `functions.php`.
- To roll back: open the merged PR → **Revert** → merge the revert PR → approve the deploy.
