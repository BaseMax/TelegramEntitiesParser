# Telegram Entities Parser

A program to parse and decode formatted part of the Telegram message text with UTF8 support.

#### Types

- text_mention
- url

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
