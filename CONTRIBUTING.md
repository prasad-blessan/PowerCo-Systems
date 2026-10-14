# Change workflow: local → pull request → staging → production

| Environment | Site | Deploy |
|---|---|---|
| `staging` | Staging (test) site | After approval |
| `production` | https://powerco.free.nf | After approval |

`main` is protected: changes arrive only through pull requests. Every merge that changes the theme starts one deploy run with both environments waiting for approval.

## 1. Edit locally
1. In VS Code, open **Source Control** (Ctrl+Shift+G). Switch to `main` and **Pull**.
2. Create a branch: click the branch name (bottom-left) → **Create new branch** → e.g. `feature/hero-text`.
3. Edit theme files in `wp-content/themes/powerco/` and check at http://localhost/wordpress-web.

## 2. Commit and push
1. In **Source Control**, write a message and click **Commit**.
2. Click **Publish Branch** (first time) or **Sync Changes**.

## 3. Pull request
1. On GitHub: **Pull requests → New pull request**, base `main` ← your branch.
2. Wait for **PR check** to pass, then **Merge pull request**.

## 4. Approve staging, then production
1. **Actions** → the **Deploy theme** run → **Review deployments**.
2. Tick **staging** → **Approve and deploy**. Test the staging site.
3. **Review deployments** again → tick **production** → **Approve and deploy**.
   - Not happy with staging? Tick **production** → **Reject** instead, fix it in a new PR.
4. Check https://powerco.free.nf (Ctrl+F5).

## Notes
- Only theme code deploys. Page text, menus and Customizer settings live in each site's database: edit them in that site's wp-admin.
- A Customizer value on a site overrides the default in `functions.php`.
- Roll back: open the merged PR → **Revert** → merge the revert PR → approve the deploys.
