# Setup signed commit

1. Generate a new GPG key

```bash
gpg --gen-key
```
2. Setup Git to use the GPG key

```bash
git config --global user.signingkey <key-id>
git config --global commit.gpgsign true
```

3. Export the public key

```bash
gpg --armor --export <key-id>
```

4. Add the public key to [GitHub](https://docs.github.com/en/authentication/managing-commit-signature-verification/adding-a-gpg-key-to-your-github-account)

💡 How to find your GPG key ID?

```bash
gpg --list-secret-keys --keyid-format LONG
```
