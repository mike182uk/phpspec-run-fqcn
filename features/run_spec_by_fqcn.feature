Feature: Run spec by FQCN
  In order to run a spec for a given class without knowing the path to the spec
  As a developer
  I want to be able to run a spec for a given class by supplying its FQCN to the run command

  Scenario Outline: Spec is run for given FQCN
    Given "<src>" exists
    When I run the spec for "<src>"
    Then the spec for "<src>" should be successfully run

    Examples:
      | src         |
      | Foo\Bar     |
      | Foo\Bar\Baz |
