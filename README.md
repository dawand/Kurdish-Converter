# Kurdish Converter
This project allows you to convert any English number, time, or date to Kurdish text

You can try this [live demo](http://bepele.com/KurdishConverter)

## Screenshots

Covert a number:
![number](https://cloud.githubusercontent.com/assets/1923321/20031801/42ee0280-a375-11e6-9019-091ac4e36310.png)
Covert a time:
![time](https://cloud.githubusercontent.com/assets/1923321/20031800/42ebe9c8-a375-11e6-8966-61f112425524.png)
Covert a date:
![date](https://cloud.githubusercontent.com/assets/1923321/20031833/e2b895fa-a375-11e6-863b-e9d00de957a6.png)

## Usage

1. Include `KurdishConveter.php` into your project folder.
2. Create an instance of it:
```
$KC = new KurdishConverter("ReplaceWithAnyEnglishNumber");
```
3. Call generateText() method:
```
$output = $KC->generateText();
```
4. print the output:
```
echo $output;
```
## Contributing

1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request! :blush:

## License

The MIT License (MIT)

Copyright (c) [2016] [Dawand Sulaiman]

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
