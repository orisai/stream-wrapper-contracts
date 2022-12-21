# Stream Wrapper Contracts

Interface for PHP stream wrapper methods

## Content

- [Setup](#setup)
- [Usage](#usage)

## Setup

Install with [Composer](https://getcomposer.org)

```sh
composer require orisai/stream-wrapper-contracts
```

## Usage

Implement `StreamWrapper` interface

```php
use Orisai\StreamWrapperContracts\StreamWrapper;

final class ExampleStreamWrapper implements StreamWrapper
{

	// ...

}
```
