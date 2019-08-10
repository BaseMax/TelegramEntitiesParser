# Telegram Entities Parser

A program to parse and decode formatted part of the Telegram message text with UTF8 support.

#### Message Entity Types

- [x] url
- [x] mention (@username)
- [x] text_mention (for users without usernames)
- [ ] hashtag
- [ ] cashtag
- [ ] bot_command
- [ ] email
- [ ] phone_number
- [ ] bold (bold text)
- [ ] italic (italic text)
- [ ] code (monowidth string)
- [ ] pre (monowidth block)
- [ ] text_link (for clickable text URLs)

## Example

#### Input

```
✳️✳️✳️ Help ✳️✳️✳️
Uname Max
Uname requested help
https://t.me/c/11/13
```

#### Detect

```
---> Uname
---> Max
---> Uname
---> https://t.me/c/11/13
```

#### Output

```
✳️✳️✳️ Help ✳️✳️✳️
<a href="https://t.me/Uname">Uname</a> <a href="https://t.me/max">Max</a> 
<a href="https://t.me/Uname">Uname</a> requested help
<a href="https://t.me/c/11/13">https://t.me/c/11/13</a>
```

--------

## Message Entity

- https://core.telegram.org/bots/api#message
- https://core.telegram.org/bots/api#messageentity

### Telegram Bot API

- https://core.telegram.org/bots/api
- https://core.telegram.org/bots
