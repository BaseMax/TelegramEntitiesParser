# Telegram Entities Parser

A program to parse and decode formatted part of the Telegram message text with UTF8 support.

#### Types

- text_mention
- url

## Example

#### Input

```
✳️✳️✳️ Help ✳️✳️✳️
Aztek $t€ph!n 
Aztek requested help
https://t.me/c/10954501/103
```

#### Detect

```
---> Aztek
---> $t€ph!n
---> Aztek
---> https://t.me/c/10954501/103
```

#### Output

```
✳️✳️✳️ Help ✳️✳️✳️
<a href="https://t.me/Aztek">Aztek</a> <a href="https://t.me/step">$t€ph!n</a> 
<a href="https://t.me/Aztek">Aztek</a> requested help
<a href="https://t.me/c/10954501/103">https://t.me/c/10954501/103</a>
```
