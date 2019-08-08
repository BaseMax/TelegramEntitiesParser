# Telegram Entities Parser

A program to parse and decode formatted part of the Telegram message text with UTF8 support.

#### Types

- text_mention
- url

## Using


#### Input

```
✳️✳️✳️ Help ✳️✳️✳️
Aztek_btc $t€ph!n 
Aztek_btc requested help
https://t.me/c/1095432501/1003
```

#### Detect

```
---> Aztek_btc
---> $t€ph!n
---> Aztek_btc
---> https://t.me/c/1095432501/1003
```

#### Output

```
✳️✳️✳️ Help ✳️✳️✳️
<a href="https://t.me/Aztek_btc">Aztek_btc</a> <a href="https://t.me/stephin">$t€ph!n</a> 
<a href="https://t.me/Aztek_btc">Aztek_btc</a> requested help
<a href="https://t.me/c/1095432501/1003">https://t.me/c/1095432501/1003</a>
```
