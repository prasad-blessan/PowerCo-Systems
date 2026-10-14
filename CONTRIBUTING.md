# Change workflow: local → staging → production

| Branch | Site | Deploy |
|---|---|---|
| `staging` | Staging (test) site | Automatic after merge |
| `main` | https://powerco.free.nf | After approval |

Both branches are protected: changes arrive only through pull requests.

## 1. Edit locally
1. In VS Code, open **Source Control** (Ctrl+Shift+G). Switch to `staging` and **Pull**.
2. Create a branch: click the branch name (bottom-left) → **Create new branch** → e.g. `feature/hero-text`.
3. Edit theme files in `wp-content/themes/powerco/` and check at http://localhost/wordpress-web.

## 2. Commit and push
1. In **Source Control**, write a message and click **Commit**.
2. Click **Publish Branch** (first time) or **Sync Changes**.

## 3. Pull request into staging
1. On GitHub: **Pull requests → New pull request**, base `staging` ← your branch.
2. Wait for **PR check** to pass, then **Merge pull request**.
3. **Deploy theme** runs automatically to the staging site. Test it there.

## 4. Release to production
1. **Pull requests → New pull request**, base `main` ← compare `staging`.
2. Wait for **PR check**, then **Merge pull request**.
3. **Actions** → the deploy run → **Review deployments** → tick **production** → **Approve and deploy**.
4. Check https://powerco.free.nf (Ctrl+F5).

## Notes
- Only theme code deploys. Page text, menus and Customizer settings live in each site's database: edit them in that site's wp-admin.
- A Customizer value on a site overrides the default in `functions.php`.
- Roll back: open the merged PR → **Revert** → merge the revert PR (staging first, then main).
